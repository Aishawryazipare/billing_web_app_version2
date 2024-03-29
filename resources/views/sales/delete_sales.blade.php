@extends('layouts.app')
@section('content')
<link href="css/sweetalert.css" rel="stylesheet">
    @if (Session::has('alert-success'))
    <div class="alert alert-success alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
        <h4 class="alert-heading">Success!</h4>
        {{ Session::get('alert-success') }}
    </div>
    @endif  
<section class="content-header">
    <h1>
      Cancel Bill
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Cancel Bill</li>
    </ol> 
</section>
    <section class="content">
      <div class="row">
<!--        <div class="col-md-3"></div>-->
        <div class="col-md-10">
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Cancel Bill</h3>
            </div>
              <form action="{{ url('cancel_bill') }}" method="POST" id="type_form" class="form-horizontal" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="box-body">
                    <div class="form-group">
                        <label for="lbl_cat_name" class="col-sm-2 control-label">Bill No<span style="color:#ff0000;">*</span></label>
                        <div class="col-sm-4">
                           <select class="form-control select2" style="width: 100%;" name="bill_no" required>
                         <option value="">-- Select Bill No -- </option> 
                        @foreach($bill_no as $u)
                        <option value="{{$u->bill_no}}">{{$u->bill_no}}</option>
                        @endforeach
                           </select>
                        </div>
                    </div>
                </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-success" id="btn_submit" name="btn_submit">Submit</button>
                <a href="{{url('category_data')}}" class="btn btn-danger" >Cancel</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="bower_components/select2/dist/js/select2.full.min.js"></script>
<script type='text/javascript' src='js/jquery.validate.js'></script>
<script src="js/sweetalert.min.js"></script>
<script>
 $(document).ready(function(){
    $('.select2').select2() 
    $(".category").focusout(function(){
        var category = $(this).val();
         $.ajax({
                    url: 'check-exist',
                            type: "GET",
                            data: {type:"Category",data:category},
                            success: function(result) 
                            {
                            console.log(result);
                            var a=JSON.parse(result);
                            if(a=="Already Exist")
                            {
                                swal({
  position: 'top-end',
  type: 'warning',
  title: 'Already Exist',
  showConfirmButton: false,
  timer: 1500
}); 
                            }
                        }
                    });
    });
 });
     var jvalidate = $("#type_form").validate({
    rules: { 
            password : {required: true},
        },
         messages: {
             cat_name: "Please Enter Category",
           }  
    });
</script>
@endsection


