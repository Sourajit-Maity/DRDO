@extends('adminlte::page')

@section('content')
@include('include.breadcrumbs', ['breadcrumbs' => [
    'Admin' => '#',
    'Announcements' => route('view-announcements'),

]])
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
@section('plugins.Datatables', true)
    
    <div class="panel panel-default">
        <div class="panel-body">
        <div class="row">
    <div class="form-group col-md-6">
                <h2>Announcements</h2>
            </div>
            <div class="form-group col-md-6"; align="right">
                <a class="btn btn-success" href="{{ route('add-announcements') }}"><i class="fas fa-plus-square"></i></a>
            </div>
            
        </div>
            <div class="table-responsive">
           
        
               
                <table id="myTable" class="table table-bordered table-striped {{ count($announcements) > 0 ? 'datatable' : '' }} pointer">
                    <thead>
                    <tr>
                        <!-- <th style="text-align:center;"><input type="checkbox" id="select-all" /></th> -->
                        
                        <th> Announcements<p>(घोषणाओं)</p></th>
                        
                        <th>Company<p>(कंपनी)</p></th>
                        
                        
                        
                        <th>Status<p>(स्थिति)</p></th>
                        <th>Actions<p>(कार्रवाई)</p></th>
                    </tr>
                    </thead>

                    <tbody>
                    @if (count($announcements) > 0)
                        @foreach ($announcements as $value)
                            <tr data-entry-id="{{ $value->id }}">
                                <!-- <td></td> -->
                                
                                <td>{{ $value->text }}</td>
                                <td>{{ $value->c_name }}</td>
                              
                                
                                @if($value->active =='1') 
								<td>Active</td>
                          
                                @else  
                               <td>Deactive</td>  
                               @endif
                               <td>
                               <label class="switch">
                                <input id="chk_{{ $value->id }}" type="checkbox" <?php echo(($value->active == 1) ? "checked": "") ?> onchange="reset_status('{{ $value->id }}')">
                                <span class="slider round"></span>
                            </label>
                                    </td> 
                             
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7">No entries in table</td>
                        </tr>
                    @endif
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <script>

        function reset_status(id){



            $.ajax
            ({
                url: '{{ url('is-active') }}/'+id+"/"+$('#chk_'+id).is(':checked'),
                type: 'GET',
                dataType: 'json',
                success: function(data)
                {

                     alert("updated");
                }
            });


        }
</script>
    @include('footerimport')
    @include('datatable')
    @endsection

    <style>
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
th,th p {text-align: center !important;}
</style> 
  
