@props(['cat'])

<tr>
    <th  class="text-center">{{$cat->category}}</th>
    <td class="text-center">
        <form action="/category/{{$cat->id}}" method="POST">
        @csrf
        @method('DELETE')

        {{-- DELETE --}}
        <div class="btn btn-danger" onclick="showConfirmation({{'c'.$cat->id}})">Delete</div>

        <div class="modal fade" id="{{'c'.$cat->id}}" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Confirmation</h5>
                <div type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">X</span>
                </div>
              </div>
              <div class="modal-body">
                Are you sure you want to proceed? <b class="text-warning fs-5">Bewarned:</b>
                <b class="text-danger">It will delete all products with this category</b>
              </div>
              <div class="modal-footer">
                <div type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</div>

                <button type="submit" class="btn btn-success">Confirm</button>
              </div>
            </div>
          </div>
        </div>
    </form>
    </td>
</tr>