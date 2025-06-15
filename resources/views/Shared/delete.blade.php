<div id="confirmModal" class="modal fade" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" 
                    id="">
                  حذف
                </h5>
                <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action=""  id="delete" method="post">
                    @csrf
                    <h4>هل انت متاكد من عملية الحذف </h4>
                    <input type="hidden">
                    <input id="Delete_id" type="hidden" name="id" class="form-control">
                    <input id="Name_Delete" type="text" name="Name_Delete" class="form-control" disabled>


                    <div class="modal-footer">
                        <a   class="btn btn-danger submit submit_delete"><span><i
                                    class="fa fa-paper-plane"
                                    aria-hidden="true"></i></span>تاكيد
                        </a>
                        <button type="button" class="btn btn-default " data-dismiss="modal"><i
                                class="fa fa-window-close" aria-hidden="true">الغاء</i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
