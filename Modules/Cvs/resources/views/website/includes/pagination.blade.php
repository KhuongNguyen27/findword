<div class="ls-show-more">
    <div class="card-footer bg-white">
        {{ $items->appends(request()->query())->links() }}
    </div>
</div>