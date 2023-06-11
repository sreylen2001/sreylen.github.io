@extends('layouts.master')
@section('content')
<div class="content-body">
    <div class="row justify-content-center">
        <div class="col-sm-10">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                       
                        <div class="card-header">
                            <h4 class="card-title">Update Bus</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-validation">
                                <form class="needs-validation" novalidate="" action="{{url('admin/admins_bus/update')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <input type="hidden" name="id" value="{{$buses->id}}">
                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="bus_number">Bus Number</label>
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control" name="bus_number" id="bus_number" value="{{$buses->bus_number}}">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="bus_plate_number">Plate Numbers</span></label>
                                               
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control" name="bus_plate_number" id="bus_plate_number" value="{{$buses->bus_plate_number}}">
                                                </div>
                                            </div>

                

                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="bus_type">Bus Type</span>
                                                </label>
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control" name="bus_type" id="bus_type" value="{{$buses->bus_type}}">
                                                </div>
                                        </div> 
                                        </div>
                                            <div class="col-xl-6">
                                                
                                                <div class="mb-3 input-group">
                                                    <label class="col-lg-4 col-form-label" for="capacity">Capacity</span>
                                                    </label>
                                                    <div class="col-lg-6" class="form-file" textalign="center">
                                                        <input type="number" class="form-file-input form-control" name="capacity" id="capacity" value="{{$buses->capacity}}">
                                                    </div>
                                                </div>
    
                                                <button type="submit" class="btn me-2 btn-primary">Submit</button>
                                                <a href="{{ route('admin.admin_bus') }}" class="btn btn-light">Cancel</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>

@endsection