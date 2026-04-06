<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AgentController extends Controller
{
    public function index(): View
    {
        $agents = Agent::query()
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('agents.index', compact('agents'));
    }

    public function create(): View
    {
        return view('agents.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data['user_id'] = auth()->id();

        Agent::query()->create($data);

        return redirect()->route('agents.index')->with('status', __('تم حفظ الوكيل.'));
    }

    public function edit(Agent $agent): View
    {
        $this->authorizeAgent($agent);

        return view('agents.edit', compact('agent'));
    }

    public function update(Request $request, Agent $agent): RedirectResponse
    {
        $this->authorizeAgent($agent);

        $agent->update($this->validated($request));

        return redirect()->route('agents.index')->with('status', __('تم تحديث الوكيل.'));
    }

    public function destroy(Agent $agent): RedirectResponse
    {
        $this->authorizeAgent($agent);
        $agent->delete();

        return redirect()->route('agents.index')->with('status', __('تم حذف الوكيل.'));
    }

    public function exportCsv(): StreamedResponse
    {
        $agents = $this->agentsForExport();

        $filename = 'agents_'.now()->format('Y-m-d_His').'.csv';

        return response()->streamDownload(function () use ($agents): void {
            $out = fopen('php://output', 'w');
            if ($out === false) {
                return;
            }
            fprintf($out, '%s', (string) pack('CCC', 0xef, 0xbb, 0xbf));
            fputcsv($out, ['الاسم', 'الماركات', 'نظام المنتجات/المخزون', 'مندوب المبيعات', 'الهاتف', 'الموقع']);
            foreach ($agents as $agent) {
                fputcsv($out, [
                    $agent->name,
                    $this->brandsCell($agent),
                    $agent->inventorySystemDisplay(),
                    (string) ($agent->sales_rep_name ?? ''),
                    (string) ($agent->phone ?? ''),
                    (string) ($agent->location ?? ''),
                ]);
            }
            fclose($out);
        }, $filename, [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }

    public function exportXlsx(): StreamedResponse
    {
        $agents = $this->agentsForExport();

        $filename = 'agents_'.now()->format('Y-m-d_His').'.xls';

        return response()->streamDownload(function () use ($agents): void {
            echo '<?xml version="1.0" encoding="UTF-8"?>'."\n";
            echo '<html xmlns:x="urn:schemas-microsoft-com:office:excel"><head><meta charset="UTF-8">';
            echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"></head>';
            echo '<body><table border="1" dir="rtl"><thead><tr>';
            foreach (['الاسم', 'الماركات', 'نظام المنتجات/المخزون', 'مندوب المبيعات', 'الهاتف', 'الموقع'] as $h) {
                echo '<th>'.$this->escapeSpreadsheetCell($h).'</th>';
            }
            echo '</tr></thead><tbody>';
            foreach ($agents as $agent) {
                echo '<tr>';
                foreach ([
                    $agent->name,
                    $this->brandsCell($agent),
                    $agent->inventorySystemDisplay(),
                    (string) ($agent->sales_rep_name ?? ''),
                    (string) ($agent->phone ?? ''),
                    (string) ($agent->location ?? ''),
                ] as $cell) {
                    echo '<td>'.$this->escapeSpreadsheetCell($cell).'</td>';
                }
                echo '</tr>';
            }
            echo '</tbody></table></body></html>';
        }, $filename, [
            'Content-Type' => 'application/vnd.ms-excel; charset=UTF-8',
        ]);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection<int, Agent>
     */
    private function agentsForExport(): \Illuminate\Database\Eloquent\Collection
    {
        return Agent::query()
            ->where('user_id', auth()->id())
            ->latest()
            ->get();
    }

    private function brandsCell(Agent $agent): string
    {
        if (! is_array($agent->brands) || $agent->brands === []) {
            return '';
        }

        return implode('، ', $agent->brands);
    }

    private function escapeSpreadsheetCell(string $value): string
    {
        return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }

    private function authorizeAgent(Agent $agent): void
    {
        abort_unless($agent->user_id === auth()->id(), 403);
    }

    /**
     * @return array{name: string, brands: array<int, string>|null, inventory_system_type: string, inventory_system_note: string|null, sales_rep_name: string|null, phone: string|null, location: string|null}
     */
    private function validated(Request $request): array
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'brands' => ['nullable', 'array', 'max:50'],
            'brands.*' => ['nullable', 'string', 'max:255'],
            'inventory_system_type' => ['required', 'string', Rule::in(array_keys(Agent::inventorySystemTypeLabels()))],
            'inventory_system_note' => ['nullable', 'string', 'max:500'],
            'sales_rep_name' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'location' => ['nullable', 'string', 'max:2000'],
        ]);

        $brands = [];
        foreach ($data['brands'] ?? [] as $b) {
            if (is_string($b) && filled(trim($b))) {
                $brands[] = trim($b);
            }
        }
        $data['brands'] = $brands === [] ? null : $brands;

        if (in_array($data['inventory_system_type'], ['excel', 'none'], true)) {
            $data['inventory_system_note'] = null;
        } else {
            $note = is_string($data['inventory_system_note'] ?? null) ? trim($data['inventory_system_note']) : '';
            $data['inventory_system_note'] = $note === '' ? null : $note;
        }

        return $data;
    }
}
