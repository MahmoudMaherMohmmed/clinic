<td class="visible-md visible-lg">
    <div class="btn-group">
        @if (get_action_icons('content/create', 'get'))
            <a class="btn btn-sm btn-success show-tooltip" title="Add Content"
                href="{{ url('content/create?category_id=' . $value->id) }}"
                data-original-title="Add Content"><i class="fa fa-plus"></i></a>
        @endif
        @if (get_action_icons('category/{id}', 'get'))
            @if ($value->contents_count > 0)
                <a class="btn btn-sm show-tooltip" title="Show Content"
                    href="{{ url('content?category_id=' . $value->id) }}" data-original-title="show Content"><i
                        class="fa fa-step-forward"></i></a>
            @endif
        @endif
        @if (get_action_icons('category/{id}/edit', 'get'))
            <a class="btn btn-sm show-tooltip" href="{{ url("category/$value->id/edit") }}" title="Edit"><i
                    class="fa fa-edit"></i></a>
        @endif
        @if (get_action_icons('category/{id}/delete', 'get'))
            <a class="btn btn-sm show-tooltip btn-danger" onclick="return ConfirmDelete();"
                href="{{ url("category/$value->id/delete") }}" title="Delete"><i class="fa fa-trash"></i></a>
        @endif
        @if (get_action_icons('category/create', 'get'))

            <a class="btn btn-sm btn-warning show-tooltip" title="Add Sub Category"
                href="{{ url('category/create?category_id=' . $value->id) }}"
                data-original-title="Add Sub Category"><i class="fa fa-plus"></i></a>
        @endif
        @if (get_action_icons('category/create', 'get'))
            @if ($value->sub_cats_count > 0)
                <a class="btn btn-sm  btn-primary show-tooltip" title="Show Sub Category"
                    href="{{ url("category?parent_id=$value->id") }}" data-original-title="Show Sub Category"><i
                        class="fa fa-step-forward"></i></a>
            @endif
        @endif
    </div>
</td>
