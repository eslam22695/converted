@extends('layouts.admin')

@section('styles')
    <link href="{{asset('admin_assets/plugins/bootstrap-table/css/bootstrap-table.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('admin_assets/plugins/custombox/css/custombox.css')}}" rel="stylesheet">
@stop

@section('content')

<!-- Page-Title -->
<div class="row">
    <div class="col-sm-12">
        <div class="main-title-00">
            @if (Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
            @elseif(Session::has('danger'))
                <div class="alert alert-danger">{{ Session::get('danger') }}</div>
            @endif
            <h4 class="page-title">المهمات</h4>
        </div>
        
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            
            <div class="row">
                <div class="col-sm-12">
                    <div class=" main-btn-00">
                        <a href="{{ route('task.create') }}" class="btn btn-default waves-effect">اضافه مهمة  +</a>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table  data-toggle="table"
                        data-search="true"
                        data-show-columns="true"
                        data-sort-name="id"
                        data-page-list="[10, 20, 50]"
                        data-page-size="10"
                        data-pagination="true" data-show-pagination-switch="true" class="table-bordered ">
                                
                    <thead>
                        <tr>
                            <th data-field="الاسم"  data-align="center">الاسم</th>
                            <th data-field="الوصف"  data-align="center">الوصف</th>
                            <th data-field="الاسم المعين"  data-align="center">الاسم المعين</th>
                            <th data-field="اسم الادمن"  data-align="center">اسم الادمن</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($tasks))
                            @foreach($tasks as $task)
                                <tr>
                                    <td>{{$task->title}}</td>
                                    <td>{{$task->description}}</td>
                                    <td>{{$task->assigned_to->name??''}}</td>
                                    <td>{{$task->assigned_by->name??''}}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

    </div> <!-- end col -->

</div>
    
@endsection

@section('scripts')
   <script src="{{asset('admin_assets/plugins/bootstrap-table/js/bootstrap-table.js')}}"></script>
   <script src="{{asset('admin_assets/pages/jquery.bs-table.js')}}"></script>
@stop