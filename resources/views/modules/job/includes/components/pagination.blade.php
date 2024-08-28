<div class="ls-show-more">
    <div class="card-footer">
        {{ $items->appends(request()->query())->links() }}
    </div>
</div>