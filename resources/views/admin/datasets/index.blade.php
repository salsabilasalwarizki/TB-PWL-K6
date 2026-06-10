@extends('layouts.admin')
@section('title', 'Manage Datasets')
@section('page-title', 'Dataset Management')

@section('content')
<div class="space-y-6">
  
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="text-2xl font-bold text-ink-900 dark:text-white">Datasets</h2>
            <p class="text-sm text-ink-500 mt-1">Manage and review all datasets in the repository</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.datasets.export') }}" class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-medium text-ink-700 dark:text-ink-300 bg-white dark:bg-ink-900 border border-ink-300 dark:border-ink-700 rounded-lg hover:bg-ink-50 dark:hover:bg-ink-800 hover:shadow-soft transition-all">
                <i class="bi bi-download"></i>
                <span>Export CSV</span>
            </a>
            <a href="{{ route('contribute.policy') }}" class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-medium text-white bg-gradient-to-r from-brand-600 to-sphere-600 rounded-lg hover:shadow-lg hover:shadow-brand-500/30 transition-all">
                <i class="bi bi-plus-circle"></i>
                <span>Add New</span>
            </a>
        </div>
    </div>

    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white dark:bg-ink-900 rounded-xl shadow-card border border-ink-200 dark:border-ink-800 p-5 hover:-translate-y-0.5 hover:shadow-elev transition-all">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center shadow-soft">
                    <i class="bi bi-database text-xl text-white"></i>
                </div>
                <div>
                    <p class="text-xs text-ink-500 mb-1">Total</p>
                    <p class="text-2xl font-bold text-ink-900 dark:text-white">{{ $stats['total'] }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white dark:bg-ink-900 rounded-xl shadow-card border border-ink-200 dark:border-ink-800 p-5 hover:-translate-y-0.5 hover:shadow-elev transition-all">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-amber-500 to-amber-600 flex items-center justify-center shadow-soft">
                    <i class="bi bi-clock-history text-xl text-white"></i>
                </div>
                <div>
                    <p class="text-xs text-ink-500 mb-1">Pending</p>
                    <p class="text-2xl font-bold text-ink-900 dark:text-white">{{ $stats['pending'] }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white dark:bg-ink-900 rounded-xl shadow-card border border-ink-200 dark:border-ink-800 p-5 hover:-translate-y-0.5 hover:shadow-elev transition-all">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-emerald-500 to-emerald-600 flex items-center justify-center shadow-soft">
                    <i class="bi bi-check-circle text-xl text-white"></i>
                </div>
                <div>
                    <p class="text-xs text-ink-500 mb-1">Approved</p>
                    <p class="text-2xl font-bold text-ink-900 dark:text-white">{{ $stats['approved'] }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white dark:bg-ink-900 rounded-xl shadow-card border border-ink-200 dark:border-ink-800 p-5 hover:-translate-y-0.5 hover:shadow-elev transition-all">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-red-500 to-red-600 flex items-center justify-center shadow-soft">
                    <i class="bi bi-x-circle text-xl text-white"></i>
                </div>
                <div>
                    <p class="text-xs text-ink-500 mb-1">Rejected</p>
                    <p class="text-2xl font-bold text-ink-900 dark:text-white">{{ $stats['rejected'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white dark:bg-ink-900 rounded-xl shadow-card border border-ink-200 dark:border-ink-800 p-5">
        <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-xs font-semibold text-ink-600 dark:text-ink-400 mb-2">Search</label>
                <div class="relative">
                    <i class="bi bi-search absolute left-3 top-1/2 -translate-y-1/2 text-ink-400"></i>
                    <input type="text" name="search" 
                           placeholder="Search datasets..." 
                           value="{{ request('search') }}"
                           class="w-full pl-10 pr-4 py-2.5 rounded-lg bg-ink-50 dark:bg-ink-800 border border-ink-300 dark:border-ink-700 text-sm text-ink-900 dark:text-white placeholder-ink-400 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition-all">
                </div>
            </div>
            <div>
                <label class="block text-xs font-semibold text-ink-600 dark:text-ink-400 mb-2">Status</label>
                <select name="status" class="w-full px-4 py-2.5 rounded-lg bg-ink-50 dark:bg-ink-800 border border-ink-300 dark:border-ink-700 text-sm text-ink-900 dark:text-white focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition-all appearance-none cursor-pointer">
                    <option value="">All Status</option>
                    <option value="pending" {{ request('status')=='pending'?'selected':'' }}>Pending</option>
                    <option value="approved" {{ request('status')=='approved'?'selected':'' }}>Approved</option>
                    <option value="available" {{ request('status')=='available'?'selected':'' }}>Available</option>
                    <option value="rejected" {{ request('status')=='rejected'?'selected':'' }}>Rejected</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold text-ink-600 dark:text-ink-400 mb-2">Sort By</label>
                <select name="sort" class="w-full px-4 py-2.5 rounded-lg bg-ink-50 dark:bg-ink-800 border border-ink-300 dark:border-ink-700 text-sm text-ink-900 dark:text-white focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition-all appearance-none cursor-pointer">
                    <option value="created_at" {{ request('sort')=='created_at'?'selected':'' }}>Newest</option>
                    <option value="name" {{ request('sort')=='name'?'selected':'' }}>Name A-Z</option>
                    <option value="view_count" {{ request('sort')=='view_count'?'selected':'' }}>Most Viewed</option>
                    <option value="download_count" {{ request('sort')=='download_count'?'selected':'' }}>Most Downloaded</option>
                </select>
            </div>
            <div class="flex items-end">
                <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-medium text-white bg-gradient-to-r from-brand-600 to-sphere-600 rounded-lg hover:shadow-lg hover:shadow-brand-500/30 transition-all">
                    <i class="bi bi-funnel"></i>
                    <span>Filter</span>
                </button>
            </div>
        </form>
    </div>

    <div class="bg-white dark:bg-ink-900 rounded-xl shadow-card border border-ink-200 dark:border-ink-800 overflow-hidden">
        <form method="POST" action="{{ route('admin.datasets.bulk-action') }}" id="bulkForm">
            @csrf
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-ink-50 dark:bg-ink-800">
                        <tr>
                            <th class="px-4 py-3 text-left w-12">
                                <input type="checkbox" id="selectAll" class="w-4 h-4 rounded border-ink-300 dark:border-ink-600 text-brand-600 focus:ring-brand-500">
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-ink-600 dark:text-ink-400 uppercase tracking-wider">Name</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-ink-600 dark:text-ink-400 uppercase tracking-wider">Subject</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-ink-600 dark:text-ink-400 uppercase tracking-wider">Status</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-ink-600 dark:text-ink-400 uppercase tracking-wider">Views</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-ink-600 dark:text-ink-400 uppercase tracking-wider">Date</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-ink-600 dark:text-ink-400 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-ink-200 dark:divide-ink-800">
                        @forelse($datasets as $ds)
                        <tr class="hover:bg-ink-50 dark:hover:bg-ink-800 transition-colors">
                            <td class="px-4 py-4">
                                <input type="checkbox" name="dataset_ids[]" value="{{ $ds->dataset_id }}" class="w-4 h-4 rounded border-ink-300 dark:border-ink-600 text-brand-600 focus:ring-brand-500 dataset-checkbox">
                            </td>
                            <td class="px-4 py-4">
                                <div class="flex items-center gap-3">
                                    @if($ds->thumbnail_url)
                                    <img src="{{ $ds->thumbnail_url }}" alt="" class="w-10 h-10 rounded-lg object-cover shadow-soft">
                                    @else
                                    <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-brand-500 to-sphere-500 flex items-center justify-center shadow-soft">
                                        <i class="bi bi-database text-white"></i>
                                    </div>
                                    @endif
                                    <div>
                                        <a href="{{ route('datasets.show', $ds) }}" class="font-semibold text-ink-900 dark:text-white hover:text-brand-600 dark:hover:text-brand-400 transition-colors">
                                            {{ Str::limit($ds->name, 40) }}
                                        </a>
                                        @if($ds->data_type)
                                        <p class="text-xs text-ink-500 mt-0.5">{{ $ds->data_type }}</p>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-4">
                                <span class="inline-flex px-2.5 py-1 text-xs font-medium text-ink-700 dark:text-ink-300 bg-ink-100 dark:bg-ink-800 rounded-md">
                                    {{ $ds->subject_area ?? 'N/A' }}
                                </span>
                            </td>
                            <td class="px-4 py-4">
                                <span class="inline-flex px-2.5 py-1 text-xs font-medium rounded-md
                                    {{ $ds->status==='approved' ? 'bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400' : '' }}
                                    {{ $ds->status==='available' ? 'bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400' : '' }}
                                    {{ $ds->status==='rejected' ? 'bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400' : '' }}
                                    {{ $ds->status==='pending' ? 'bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400' : '' }}
                                ">
                                    {{ ucfirst($ds->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-4">
                                <span class="inline-flex items-center gap-1.5 text-sm text-ink-600 dark:text-ink-400">
                                    <i class="bi bi-eye"></i>
                                    {{ number_format($ds->view_count) }}
                                </span>
                            </td>
                            <td class="px-4 py-4">
                                <span class="text-sm text-ink-500">{{ $ds->created_at->format('M d, Y') }}</span>
                            </td>
                            <td class="px-4 py-4">
                                <div class="flex items-center gap-1">
                                    <a href="{{ route('admin.datasets.edit', $ds) }}" class="p-2 text-ink-600 dark:text-ink-400 hover:text-brand-600 dark:hover:text-brand-400 hover:bg-ink-100 dark:hover:bg-ink-800 rounded-lg transition-colors" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    @if($ds->status==='pending')
                                    <button type="button" onclick="quickAction('approve', {{ $ds->dataset_id }})" class="p-2 text-ink-600 dark:text-ink-400 hover:text-emerald-600 dark:hover:text-emerald-400 hover:bg-ink-100 dark:hover:bg-ink-800 rounded-lg transition-colors" title="Approve">
                                        <i class="bi bi-check"></i>
                                    </button>
                                    <button type="button" onclick="quickAction('reject', {{ $ds->dataset_id }})" class="p-2 text-ink-600 dark:text-ink-400 hover:text-amber-600 dark:hover:text-amber-400 hover:bg-ink-100 dark:hover:bg-ink-800 rounded-lg transition-colors" title="Reject">
                                        <i class="bi bi-x"></i>
                                    </button>
                                    @endif
                                    <button type="button" onclick="confirmDelete('{{ route('admin.datasets.destroy', $ds) }}')" class="p-2 text-ink-600 dark:text-ink-400 hover:text-red-600 dark:hover:text-red-400 hover:bg-ink-100 dark:hover:bg-ink-800 rounded-lg transition-colors" title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-4 py-12 text-center">
                                <i class="bi bi-inbox text-5xl text-ink-300 dark:text-ink-600 mb-3"></i>
                                <p class="text-ink-500">No datasets found.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($datasets->count())
            <div class="px-4 py-3 bg-ink-50 dark:bg-ink-800 border-t border-ink-200 dark:border-ink-800 flex flex-wrap justify-between items-center gap-3">
                <div class="flex items-center gap-3">
                    <select name="action" class="px-3 py-2 rounded-lg bg-white dark:bg-ink-900 border border-ink-300 dark:border-ink-700 text-sm text-ink-900 dark:text-white focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 transition-all appearance-none cursor-pointer" style="min-width: 180px;">
                        <option value="">Bulk Actions...</option>
                        <option value="approve">Approve Selected</option>
                        <option value="reject">Reject Selected</option>
                        <option value="mark_available">Mark as Available</option>
                        <option value="delete">Delete Selected</option>
                    </select>
                    <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-brand-600 to-sphere-600 rounded-lg hover:shadow-lg hover:shadow-brand-500/30 transition-all">
                        <span>Apply</span>
                    </button>
                    <span class="text-sm text-ink-500 ml-2">{{ $datasets->total() }} items</span>
                </div>
                {{ $datasets->withQueryString()->links() }}
            </div>
            @endif
        </form>
    </div>
</div>

<form id="deleteForm" method="POST" class="hidden">
    @csrf
    @method('DELETE')
</form>
@endsection

@push('scripts')
<script>
document.getElementById('selectAll')?.addEventListener('change', e => 
    document.querySelectorAll('.dataset-checkbox').forEach(c => c.checked = e.target.checked)
);

function quickAction(action, id) {
    if (action === 'reject' && !confirm('Are you sure you want to reject this dataset?')) {
        return;
    }
    
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = `{{ url('admin/datasets') }}/${id}/${action}`;
    form.innerHTML = `<input type="hidden" name="_token" value="{{ csrf_token() }}">`;
    document.body.appendChild(form);
    form.submit();
}

function confirmDelete(url) {
    if(confirm('Are you sure you want to delete this dataset? This action cannot be undone.')) {
        document.getElementById('deleteForm').action = url;
        document.getElementById('deleteForm').submit();
    }
}
</script>
@endpush
