@extends('layouts.adminMaster')

@section('page_title', trans('admin.list', ['name' => trans('admin.tour')]))
@section('main_title', trans('admin.list', ['name' => trans('admin.tour')]))

@include('includes.CKeditorScript')

@push('styles')
{!! Html::Style('css/adminTourStyle.css') !!}
@endpush

@section('content')
<table id="table" class="display" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th></th>
            <th>{!! trans('tour.name') !!}</th>
            <th>{!! trans('tour.category') !!}</th>
            <th>{!! trans('tour.price') !!}</th>
            <th>{!! trans('tour.num_day') !!}</th>
            <th>{!! trans('tour.rate') !!}</th>
            <th>{!! trans('tour.num_reviews') !!}</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th></th>
            <th>{!! trans('tour.name') !!}</th>
            <th>{!! trans('tour.category') !!}</th>
            <th>{!! trans('tour.price') !!}</th>
            <th>{!! trans('tour.num_day') !!}</th>
            <th>{!! trans('tour.rate') !!}</th>
            <th>{!! trans('tour.num_reviews') !!}</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </tfoot>
</table>
<!-- Modal edit-->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="modal-title"></h4>
                <!--end modal-header-->
            </div>
            <div class="modal-body">
                {!! Form::open(['class' => 'form-horizontal', 'method' => 'post', 'id' => 'form_modal']) !!}
                    {!! Form::hidden('id', null) !!}
                    <div class="form-group">
                        {!! Form::label('category_id', trans('tour.category'), [
                            'class' => 'col-md-2 control-label'
                        ]) !!}
                        <div class="col-md-8">
                            {!! Form::select('category_id', [], null, [
                                'class' => 'form-control',
                                'placeholder' => trans('tour.choose_category')
                            ]) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('places_list', trans('tour.places'), [
                            'class' => 'col-md-2 control-label'
                        ]) !!}
                        <div class="col-md-6">
                            {!! Form::select('places_list', [], null, [
                                'class' => 'form-control',
                                'placeholder' => trans('tour.choose_place')
                            ]) !!}
                        </div>
                        <div class="col-md-2">
                            {!! Form::button(trans('admin.add'), ['class' => 'btn btn-primary btn-add-places']) !!}
                        </div>
                        <div class="col-md-8 col-md-offset-2" id="place_id"></div>
                    </div>
                    <div class="form-group">
                        {!! Form::label(
                            'name',
                            trans('tour.name'),
                            ['class' => 'col-md-2 control-label']
                        ) !!}
                        <div class="col-md-8">
                            {!! Form::text('name', null, [
                                'class' => 'form-control',
                                'placeholder' => trans('tour.write_name')
                            ]) !!}
                        </div>
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label(
                            'price',
                            trans('tour.price'),
                            ['class' => 'col-md-2 control-label']
                        ) !!}
                        <div class="col-md-8">
                            {!! Form::number('price', null, [
                                'class' => 'form-control',
                                'placeholder' => trans('tour.write_price')
                            ]) !!}
                        </div>
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label(
                            'num_day',
                            trans('tour.num_day'),
                            ['class' => 'col-md-2 control-label']
                        ) !!}
                        <div class="col-md-8">
                            {!! Form::number('num_day', null, [
                                'class' => 'form-control',
                                'placeholder' => trans('tour.write_num_day')
                            ]) !!}
                        </div>
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label(
                            'description',
                            trans('tour.description'),
                            ['class' => 'col-md-2 control-label']
                        ) !!}
                        <div class="col-md-8">
                            {!! Form::textarea('description', null, [
                                'class' => 'form-control',
                                'rows' => config('common.textarea.rows'),
                                'cols' => config('common.textarea.cols'),
                            ]) !!}
                            <script>
                                CKEDITOR.replace('description');
                            </script>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-md-3 col-md-offset-9">
                            {!! Form::button(trans('admin.save'), ['class' => 'btn btn-primary btn_save']) !!}
                        </div>
                    </div>
                {!! Form::close() !!}
                <!--end modal-body-->
            </div>
            <!--end modal-content-->
        </div>
    </div>
</div>
<!-- Modal show full-->
<div class="modal fade" id="modal-show-tour" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">title title title title title</h4>
                <!--end modal-header-->
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6 col-xs-12">
                        <div class="row">
                            <div class="col-md-4 col-sm-6 col-xs-4">
                                <div class="tour-image hvr-shadow-radial" style="background-image: url(http://dulichanhsaomoi.com/upload/images/resize/du-lich-anh-sao-moi-03114703112012-Ha%20Long.jpg)"></div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-4">
                                <div class="tour-image hvr-shadow-radial" style="background-image: url(http://www.fiditour.vn/japanese/images/hinhvietnam/doi%20che%20moc%20chau.jpg)"></div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-4">
                                <div class="tour-image hvr-shadow-radial" style="background-image: url(http://dulichanhsaomoi.com/upload/images/resize/du-lich-anh-sao-moi-03114703112012-Ha%20Long.jpg)"></div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-4">
                                <div class="tour-image hvr-shadow-radial" style="background-image: url(http://www.fiditour.vn/japanese/images/hinhvietnam/doi%20che%20moc%20chau.jpg)"></div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-4">
                                <div class="tour-image hvr-shadow-radial" style="background-image: url(http://dulichanhsaomoi.com/upload/images/resize/du-lich-anh-sao-moi-03114703112012-Ha%20Long.jpg)"></div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-4">
                                <div class="tour-image hvr-shadow-radial" style="background-image: url(http://www.fiditour.vn/japanese/images/hinhvietnam/doi%20che%20moc%20chau.jpg)"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xs-12">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-xs-5 tour-property">Category</div>
                                    <div class="col-xs-7">xyz kml uti enba adem</div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-xs-5 tour-property">Place</div>
                                    <div class="col-xs-7 place-group">
                                        <div>abc jtl rieoa serm adsw</div>
                                        <div>def ploc dhtnem asdw lqsi</div>
                                        <div>ghi yahuqi sdna qha dhhrwe</div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-xs-5 tour-property">Price</div>
                                    <div class="col-xs-7">$3000</div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-xs-5 tour-property">Rate average</div>
                                    <div class="col-xs-7">5</div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-xs-5 tour-property">Reviews</div>
                                    <div class="col-xs-7">15</div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm-12 col-xs-12">
                        <div class="panel panel-success">
                            <div class="panel-heading">Tour schedule</div>
                            <div class="panel-body">
                                <ul class="nav nav-tabs">
                                    <li class="active">
                                        <a data-toggle="tab" href="#tour-active">Active</a>
                                    </li>
                                    <li>
                                        <a data-toggle="tab" href="#tour-old">Old</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div id="tour-active" class="tab-pane fade in active">
<table class="table table-hover tour-schedule-table">
<thead>
<tr>
<th>Firstname</th>
<th>Lastname</th>
<th>Email</th>
</tr>
</thead>
<tbody>
<tr>
<td>John</td>
<td>Doe</td>
<td>john@example.com</td>
</tr>
<tr>
<td>Mary</td>
<td>Moe</td>
<td>mary@example.com</td>
</tr>
<tr>
<td>July</td>
<td>Dooley</td>
<td>july@example.com</td>
</tr>
</tbody>
</table>
                                    </div>
                                    <div id="tour-old" class="tab-pane fade">
<table class="table table-hover tour-schedule-table">
<thead>
<tr>
<th>Firstname</th>
<th>Lastname</th>
<th>Email</th>
</tr>
</thead>
<tbody>
<tr>
<td>John</td>
<td>Doe</td>
<td>john@example.com</td>
</tr>
<tr>
<td>Mary</td>
<td>Moe</td>
<td>mary@example.com</td>
</tr>
<tr>
<td>July</td>
<td>Dooley</td>
<td>july@example.com</td>
</tr>
</tbody>
</table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-info">
                            <div class="panel-heading">Description</div>
                            <div class="panel-body tour-description">Panel Content</div>
                        </div>
                    </div>
                </div>
                <!--end modal-body-->
            </div>
            <!--end modal-content-->
        </div>
    </div>
</div>
@endsection

@include('includes.ajaxSendRequest')
@include('includes.datatableBase')

@push('scripts')
{!! Html::script('js/adminTour.js') !!}
<script type="text/javascript">
    $(document).ready(function () {
        var Tour = new tour({
            url: {
                'ajaxShow': '{!! asset('admin/tour/ajax/show') !!}',
                'ajaxList': '{!! route('admin.tour.ajax.list') !!}',
                'ajaxCreate': '{!! route('admin.tour.ajax.create') !!}',
                'ajaxUpdate': '{!! route('admin.tour.ajax.update') !!}',
                'ajaxDelete': '{!! route('admin.tour.ajax.delete') !!}',
                'ajaxListCategory': '{!! route('admin.category.ajax.listOnly') !!}',
                'ajaxListPlaces': '{!! route('admin.place.ajax.listOnly') !!}',
            },
            lang: {
                'trans': {
                    'title_create': '{!! trans('tour.title_create') !!}',
                    'title_update': '{!! trans('tour.title_update') !!}',
                },
            }
        });
    });
</script>
@endpush
