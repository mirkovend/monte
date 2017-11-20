@extends('template.theme')

@section('css')
<link href='{{ asset("assets/datatable/jquery.dataTables.min.css") }}' rel="stylesheet">
<link href='{{ asset("assets/ui/lib/dp/dist/datepicker.min.css") }}' rel="stylesheet">

@stop
@section('content')
<div class="row wrapper white-bg page-heading">
  <div class="col-lg-12">
    <h2 style="color: #2F4050; font-size: 16px; font-weight: 400; margin-top: 18px">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#" style="color:#2196f3">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="#" style="color:#2196f3">Petty Cash</a></li>
            <li class="breadcrumb-item active">Add Petty Cash</li>
        </ol>
    </h2>
  </div>
</div>
<div class="wrapper wrapper-content animated fadeIn">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Petty Cash Info</h5>

                </div>
                
                {!! Form::model($pcf,['method'=>'PATCH','action'=>['PettycashController@update',$id]]) !!}
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            @if($newsupplier == NULL)
                            <div class="form-group">
                                {!! Form::label('','PCF To:') !!}
                                {!! Form::select('pcf_to',collect(['' => 'PLEASE SELECT'] + $supplier->all()),null,['class'=>'form-control select']) !!}
                            </div>
                            @else
                            <div class="form-group">
                                {!! Form::label('','To:') !!}
                                {!! Form::select('pcf_to',collect(['' => 'PLEASE SELECT'] + $supplier->all()),$newsupplier->id,['class'=>'form-control select']) !!}
                            </div>
                            @endif
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                            <div class="form-group">
                                <button type="button" style="margin-top:25px;" class="btn btn-primary" data-toggle="modal" href="#myModal"><span class="fa fa-plus"></span></button>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row spacing">
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="form-group">
                                {!! Form::label('','Date:') !!}
                                {!! Form::text('dt',null,['class'=>'form-control dt']) !!}
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="form-group">
                                {!! Form::label('','PCF Number:') !!}
                                {!! Form::text('pcf_number',null,['class'=>'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="form-group">
                                {!! Form::label('','Department:') !!}
                                {!! Form::select('dept',[''=>'PLEASE SELECT','ADMIN'=>'ADMIN','GADMIN'=>'GENERAL ADMIN','HATCHERY'=>'HATCHERY','LAYER'=>'LAYER'],null,['class'=>'form-control select']) !!}
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <div class="form-group">
                                {!! Form::label('','Received By:') !!}
                                {!! Form::text('received_by',null,['class'=>'form-control']) !!}
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="clearfix"></div>
                    <div id="wrap">
                        <?php $y = 0;?>
                        @foreach($pcf_items as $data)
                        <div class="wrapps{{$y}}">
                            <div class="col-md-2">
                                <div class="form-group">
                                    {!! Form::label('','Item Name:') !!}
                                    {!! Form::select('account_item_id[]',collect(['' => 'PLEASE SELECT'] + $coa_item->all()),$data->account_item_id,['class'=>'form-control select']) !!}
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    {!! Form::label('','Description:') !!}
                                   
                                    {!! Form::text('description[]',$data->description,['class'=>'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    {!! Form::label('','Quantity:') !!}
                                   
                                    {!! Form::text('qty[]',$data->qty,['class'=>'form-control','id'=>'qty']) !!}
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    {!! Form::label('','Unit Cost:') !!}
                                 
                                    {!! Form::text('unit_cost[]',$data->unit_cost,['class'=>'form-control','id'=>'unit_cost']) !!}
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    {!! Form::label('','Amount:') !!}
                                    
                                    {!! Form::text('amount[]',$data->amount,['class'=>'form-control','id'=>'amount']) !!}
                                </div>
                            </div>
                            @if($y > 0)
                            <div class="col-md-1">
                                <div class="form-group">
                                    <button type="button" class="btn btn-danger minus" style="margin-top:24px;"><i class="fa fa-minus" aria-hidden="true"></i></button>
                                </div>
                            </div>
                            @else
                            <div class="col-md-1">
                                <div class="form-group">
                                    <button type="button" class="btn btn-primary " id="bot" style="margin-top:24px;"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                </div>
                            </div>
                            @endif
                        </div>
                        <?php $y++;?>
                        @endforeach
                    </div>
                    <div class="clearfix"></div>
                    <hr>
                    <div class="row spacing">
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::submit('SAVE ENTRY', ['class'=>'btn btn-primary','style'=>'margin-top:0px;']) !!}
                            </div>
                        </div>    
                    </div>
                </div> <!-- END IBOXCONTENT-->
                {!! Form::close() !!}
            </div>
            
        </div>

       <!-- Widget-1 end-->

        <!-- Widget-2 end-->
    </div> <!-- Row end-->
    <div id="ajax-modal" class="modal container fade-scale" tabindex="-1" style="display: none;"></div>
<div id="ajax-modal" class="modal container fade-scale" tabindex="-1" style="display: none;"></div>
</div>
<div class="modal fade" id="myModal"  role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          {!! Form::open(['method'=>'post','action'=>'PurchaseorderController@create_supplier']) !!}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="icon-plus"></i> Add Supplier</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('','Supplier Name:') !!}
                            {!! Form::text('supplier_name',null,['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('','Beginning Balance:') !!}
                            {!! Form::text('beginning_bal',null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-lg btn-default" data-dismiss="modal">CLOSE</button>
                {!! Form::submit('INSERT ENTRY', ['class'=>'btn btn-lg btn-primary','style'=>'margin-top:0px;']) !!}
            </div>
            {!! Form::close() !!}
        </div>
      </div>
    </div>
@stop


@section('script')

<script type="text/javascript" src='{{ asset("assets/datatable/jquery.dataTables.min.js") }}'></script>

<script type="text/javascript" src='{{ asset("assets/ui/lib/dp/dist/datepicker.min.js") }}'></script>
<script type="text/javascript" src='{{ asset("assets/ui/lib/numeric.js") }}'></script>
<script type="text/javascript" src='{{ asset("assets/ui/lib/deposit.js") }}'></script>
<script type="text/javascript">
        

    $(document).ready(function() {
        var x = 1;
        $('#bot').on('click',function(){
        x++; 
        var data = '<div class="clearfix"></div><div class="wrapp'+x+'" style="margin-top:20px;"><div class="clearfix"></div><div class="col-md-2"><div class="form-group">';  
            data += '{!! Form::select("account_item_id[]",collect(["" => "PLEASE SELECT"] + $coa_item->all()),null,["class"=>"form-control select"]) !!}';
            data += '</div></div>';

            data += '<div class="col-md-3"><div class="form-group">';                       
            data += '<input type="text" name="description[]" class="form-control"/>';
            data += '</div></div>';

            data += '<div class="col-md-2"><div class="form-group">';                       
            data += '<input type="text" name="qty[]" class="form-control qty" id="qty"/>';
            data += '</div></div>';

            data += '<div class="col-md-2"><div class="form-group">';                       
            data += '<input type="text" name="unit_cost[]" class="form-control unit_cost" id="unit_cost"/>';
            data += '</div></div>';

            data += '<div class="col-md-2"><div class="form-group">';                       
            data += '<input type="text" name="amount[]" class="form-control amount" id="amount"/>';
            data += '</div></div>';

            data += '<div class="col-md-1"><div class="form-group">';  
            data += '<button type="button" class="btn btn-danger minus" ><i class="fa fa-minus" aria-hidden="true"></i></button>';
            data += '</div></div></div>';
 
            $('#wrap').append(data);
            $(".wrapp"+x+" .select").select2({
                 theme: "bootstrap"
            });
             
        });

        $('#wrap').on('click','.minus',function(){
            var $a = $(this).parent('div').parent('div').parent('div').attr('class');
            $('.'+$a).remove();
            var sum = 0;
            var num = [];
            $('.amount').each(function(){
                var total = $(this).val();
                num.push(total)
            });
            $.each(num,function(){
                sum += parseFloat(this);
            });
            
            $('#total').val(sum);
        });
   
        $(".select").select2({
             theme: "bootstrap"
        });

        $('.dt').datepicker();

        var wrapper = '#wrap';
        $(wrapper).on('keyup','.unit_cost',function(){

            var a = $(this).parent('div').parent('div').parent('div').attr('class');
            var qty =$("."+a+" .qty").val();

            console.log($(this).parent('div').parent('div').parent('div').attr('class'));
            var total1 = qty * $(this).val();
            $("."+a+' .amount').val(total1);

            var sum = 0;
            var num = [];
            $('.amount').each(function(){
                var total = $(this).val();
                num.push(total)
            });
            $.each(num,function(){
                sum += parseFloat(this);
            });
        });

    });
</script>
@stop