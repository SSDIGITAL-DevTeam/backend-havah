@extends('layouts.main')

@section('container')

<div id="content-page" class="content-page">
    <div class="container-fluid">
       <div class="row">
          <div class="col-sm-12">
                <div class="iq-card">
                   <div class="iq-card-header d-flex justify-content-between">
                      <div class="iq-header-title">
                         <h4 class="card-title">User List</h4>
                      </div>
                   </div>
                   <div class="iq-card-body">
                      <div class="table-responsive">
                         {{-- <div class="row justify-content-between">
                            <div class="col-sm-12 col-md-6">
                               <div id="user_list_datatable_info" class="dataTables_filter">
                                  <form class="mr-3 position-relative">
                                     <div class="form-group mb-0">
                                        <input type="search" class="form-control" id="exampleInputSearch" placeholder="Search" aria-controls="user-list-table">
                                     </div>
                                  </form>
                               </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                               <div class="user-list-files d-flex float-right">
                                  <a class="iq-bg-primary" href="javascript:void();" >
                                     Print
                                   </a>
                                  <a class="iq-bg-primary" href="javascript:void();">
                                     Excel
                                   </a>
                                   <a class="iq-bg-primary" href="javascript:void();">
                                     Pdf
                                   </a>
                                 </div>
                            </div>
                         </div> --}}
                         <table id="user-list-table" class="table table-striped table-bordered mt-4" role="grid" aria-describedby="user-list-page-info">
                           <thead>
                               <tr>
                                  <th>No</th>
                                  <th>Name</th>
                                  <th>birth</th>
                                  <th>Phone</th>
                                  <th>Email</th>
                                  <th>Bank Name</th>
                                  <th>No Rekening</th>
                                  <th>Name User Bank</th>
                               </tr>
                           </thead>
                           <?php 
                                $no = 1;
                            ?>
                           <tbody>
                            @foreach ($data as $d)
                            <tr>
                                <td>{{$no++}}</td>
                                {{-- <td>{{$d->image}}</td> --}}
                                <td>{{$d->name}}</td>
                                <td>{{$d->birth}}</td>
                                <td>{{$d->phone_number}}</td>
                                <td>{{$d->email}}</td>
                                <td>{{$d->bank_name}}</td>
                                <td>{{$d->no_rekening}}</td>
                                <td>{{$d->name_account}}</td>
                             </tr>
                            @endforeach
                           </tbody>
                         </table>
                      </div>
                         <div class="row justify-content-between mt-3">
                            <div id="user-list-page-info" class="col-md-6">
                               <span>Showing 1 to 5 of 5 entries</span>
                            </div>
                            <div class="col-md-6">
                               <nav aria-label="Page navigation example">
                                  <ul class="pagination justify-content-end mb-0">
                                     <li class="page-item disabled">
                                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                                     </li>
                                     <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                     <li class="page-item"><a class="page-link" href="#">2</a></li>
                                     <li class="page-item"><a class="page-link" href="#">3</a></li>
                                     <li class="page-item">
                                        <a class="page-link" href="#">Next</a>
                                     </li>
                                  </ul>
                               </nav>
                            </div>
                         </div>
                   </div>
                </div>
          </div>
       </div>
    </div>
 </div>
    
@endsection