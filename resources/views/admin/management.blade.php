@extends('layout.admin')

<!-- head -->
@section('title', 'Collaboration')
@section('style')
<!-- <link rel="stylesheet" href="{{asset('css/admin.css')}}" /> -->

@endsection
@include('common.admin_head')
<!-- header -->
@include('common.admin_header')

<!-- content -->
@section('content')
<h3><i class="fa fa-angle-right"></i> Users</h3>
<div class="col-md-12">
    <div class="content-panel">
      <table class="table table-striped table-advance table-hover">
        <h4><i class="fa fa-angle-right"></i> Users Table</h4>
        <hr>
        <thead>
          <tr>
            <th><i class="fa fa-bullhorn"></i> Company</th>
            <th class="hidden-phone"><i class="fa fa-question-circle"></i> Descrition</th>
            <th><i class="fa fa-bookmark"></i> Profit</th>
            <th><i class=" fa fa-edit"></i> Information</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
              <a href="basic_table.html#">Company Ltd</a>
            </td>
            <td class="hidden-phone">Lorem Ipsum dolor</td>
            <td>12000.00$ </td>
            <td>
              <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
            </td>
          </tr>
          <tr>
            <td>
              <a href="basic_table.html#">
                Dashio co
                </a>
            </td>
            <td class="hidden-phone">Lorem Ipsum dolor</td>
            <td>17900.00$ </td>
            <td>
              <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
            </td>
          </tr>
          <tr>
            <td>
              <a href="basic_table.html#">
                Another Co
                </a>
            </td>
            <td class="hidden-phone">Lorem Ipsum dolor</td>
            <td>14400.00$ </td>
            <td>
              <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
            </td>
          </tr>
          <tr>
            <td>
              <a href="basic_table.html#">Dashio ext</a>
            </td>
            <td class="hidden-phone">Lorem Ipsum dolor</td>
            <td>22000.50$ </td>
            <td>
              <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
            </td>
          </tr>
          <tr>
            <td>
              <a href="basic_table.html#">Total Ltd</a>
            </td>
            <td class="hidden-phone">Lorem Ipsum dolor</td>
            <td>12120.00$ </td>
            <td>
              <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
            </td>
          </tr>
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