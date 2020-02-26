@extends('layout.admin')

<!-- head -->
@section('title', 'ReportShow')
@section('style')
<!-- <link rel="stylesheet" href="{{asset('css/admin.css')}}" /> -->

@endsection
@include('common.admin_head')
<!-- header -->
@include('common.admin_header')

<!-- content -->
@section('content')
<h3><i class="fa fa-angle-right"></i> ReportShow</h3>
<div class="row mt">
  <div class="col-md-12">
    <div class="content-panel">
      <table class="table table-striped table-advance table-hover">
        <h4><i class="fa fa-angle-right"></i> {{ $title['name'] }} <i class="fa fa-angle-right"></i> {{ $title['title'] }}</h4>
        <hr>
        <thead>
          <tr>
            <th>Sender</th>
            <th>Category</th>
            <th>Detail</th>
            <th>Created</th>
          </tr>
        </thead>
        <tbody>
        @foreach($reports as $report)
          <tr>
            <td>{{ $report->sender_id  }}</td>
            <td>{{ $categories[$report->category_id-1]  }}</td>
            <td>{{ $report->detail  }}</a></td>
            <td>{{ $report->created_at  }}</a></td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
    <!-- /content-panel -->
  </div>
  <!-- /col-md-12 -->
</div>
<!-- /row -->
@endsection

<!-- footer -->
@include('common.admin_footer')