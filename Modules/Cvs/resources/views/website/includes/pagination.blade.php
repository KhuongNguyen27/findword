<div class="ls-show-more">
    <div class="ls-pagination">
        {{ $items->appends(request()->query())->links() }}
    </div>
</div>