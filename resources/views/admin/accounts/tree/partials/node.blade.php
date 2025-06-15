<div class="tree-node">

    <div class="node-content">

        <div class="node-icon">
            @if($account->children->isNotEmpty())
                <i class="fas fa-folder-open"></i>
            @else
                <i class="fas fa-file-invoice-dollar"></i>
            @endif
        </div>

        <div class="node-info">

            <div class="node-code">{{ $account->code }}</div>
            <div class="node-name">{{ $account->name }}</div>
        </div>
        <div class="node-balance d-flex align-items-center justify-content-between">
            <div class="balance-amount">
            {{ $account->net_balance }}
            </div>
            <div>
            <a class="btn btn-sm btn-outline-primary print-balance-btn" href="{{ route('admin.accounts.pdf', ['account_id'=>$account->id]) }}" target="_blank">
                <i class="fas fa-print"></i> طباعة
            </a>
            </div>
        </div>
        <div class="tree-node">
            <div class="node-content node-action">
                <button class="add-main-account-btn sub_account"  data-parent_id="{{$account->id}}">+ اضافة حساب
                    </button>
            </div>
        </div>


        @if($account->children->isNotEmpty())
            <div class="toggle-button">
                <i class="fas fa-chevron-down"></i>
            </div>
        @endif
    </div>

    @if($account->children->isNotEmpty())
        <div class="children-container" style="display: none;">
            @foreach($account->children as $child)
                @include('admin.accounts.tree.partials.node', [
                    'account' => $child,
                    'level' => $level + 1,
                    'parent' => $account
                ])
            @endforeach
        </div>
    @endif
</div>
