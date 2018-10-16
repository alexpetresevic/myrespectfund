@extends('layouts.admin')

@section('title')
    <i class="fas fa-building"></i> Funeral Homes
@endsection
@php
    $fhNoPins = [];
@endphp
@section('content')
    <div class="excel-controls" id="excel-controls">
        <a class="excel-import" id="import-funeral-homes" href="">Import From Excel</a>
        <input id="fh-excel" type="file" name="fh-excel" accept=".csv" style="display: none"/>
        <form method="get" action="{{ route('admin.funeral-home.search') }}" class="form-inline">
            <input class="form-control mr-sm-2" name="search" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            <span style="display: block;">click <a href="{{route('admin.funeral-home.search', ['no_pins' => true])}}">here</a> to see funeral homes without pins</span>
        </form>
    </div>
    <div id="funeral-homes">
        <button style="display: none;" id="fh-import-modal" type="button" class="btn btn-primary" data-toggle="modal"
                data-backdrop="static" data-keyboard="false" data-target=".import-fh">Import modal
        </button>
        <div class="modal fade import-fh" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-body">
                        <span class="cancel-upl" id="cancel-import">&times;</span>
                        <div id="row-counter">
                            <span id="current-row"></span> of <span id="max-row"></span>
                        </div>
                        <div id="progressbar" class="prog-bar__dash" style="display: none;">
                            <div id="progressbar-uploading" class="prog-bar__uploading"></div>
                            <div class="upload-text"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="block block-rounded block-bordered">
            <div class="block-table">
                <table class="table">
                    <thead>
                    <tr>
                        <th><a href="/admin/funeral-homes?{{ $filter ? 'filter=partners&' : '' }}order=name&sort={{ ($order == 'name' && $sort == 'asc') ? 'desc' : 'asc' }}">Name</a>
                            @if ($order == 'name')
                                <i class="fa fa-sort-{{ $sort == 'asc' ? 'up' : 'down' }}"></i>
                            @else
                                <i class="fa fa-sort"></i>
                            @endif
                        </th>
                        <th><a href="/admin/funeral-homes?{{ $filter ? 'filter=partners&' : '' }}order=contact_name&sort={{ ($order == 'contact_name'  && $sort == 'asc') ? 'desc' : 'asc' }}">Contact Name</a>
                            @if ($order == 'contact_name')
                                <i class="fa fa-sort-{{ $sort == 'asc' ? 'up' : 'down' }}"></i>
                            @else
                                <i class="fa fa-sort"></i>
                            @endif
                        </th>
                        <th><a href="/admin/funeral-homes?{{ $filter ? 'filter=partners&' : '' }}order=email&sort={{ ($order == 'email' && $sort == 'asc') ? 'desc' : 'asc' }}">Contact Email<a></a>
                                @if ($order == 'email')
                                    <i class="fa fa-sort-{{ $sort == 'asc' ? 'up' : 'down' }}"></i>
                                @else
                                    <i class="fa fa-sort"></i>
                            @endif
                        </th>
                        <th class="text-center"><a href="/admin/funeral-homes?{{ $filter ? 'filter=partners&' : '' }}order=created_at&sort={{ ($order == 'created_at' && $sort == 'asc') ? 'desc' : 'asc' }}">Created</a>
                            @if ($order == 'created_at')
                                <i class="fa fa-sort-{{ $sort == 'asc' ? 'up' : 'down' }}"></i>
                            @else
                                <i class="fa fa-sort"></i>
                            @endif
                        </th>
                        <th class="text-center"><a href="/admin/funeral-homes?{{ $filter ? 'filter=partners&' : '' }}order=updated_at&sort={{ ($order == 'updated_at' && $sort == 'asc') ? 'desc' : 'asc' }}">Updated</a>
                            @if ($order == 'updated_at')
                                <i class="fa fa-sort-{{ $sort == 'asc' ? 'up' : 'down' }}"></i>
                            @else
                                <i class="fa fa-sort"></i>
                            @endif
                        </th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $item)
                        <tr>
                            <td>
                                @if ($item->user_id)
                                    <i class="fas fa-briefcase"></i>&nbsp;
                                @endif
                                @if(!$item->location)
                                    @php
                                        array_push($fhNoPins, $item);
                                    @endphp
                                    <i class="fas fa-map-pin"></i>&nbsp;
                                @endif
                                {{ $item->name }}
                            </td>
                            <td>{{ $item->contact_name }}</td>
                            <td>{{ $item->email }}</td>
                            <td class="text-center">{{ $item->created_at }}</td>
                            <td class="text-center">{{ $item->updated_at }}</td>
                            <td class="text-right">
                                <a href="{{ route('admin.funeral-homes.edit', ['funeral_home' => $item->id]) }}"><i class="fas fa-edit"></i> </a>
                                <a class="delete__confirm" data-name="{{ $item->name }}" href="#0" data-form-id="{{md5($item->id)}}"><i class="fas fa-times text-danger"></i></a>
                                <form id="{{md5($item->id)}}" action="{{ route('admin.funeral-homes.destroy', ['funeralHome' => $item->id]) }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}{{ method_field('DELETE') }}
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{ $items->appends(request()->query())->links() }}
    </div>
    
    <div id="pending" class="pending-wrapper" style="display: none">
        <div class="container">
            <div class="pending__section">
                <div class="pending-block">
                    <div class="col">
                        <div class="pending-payment">
                            
                            <div class="pending">
                                <div class="loading">
                                    <div class="loading__square"></div>
                                    <div class="loading__square"></div>
                                    <div class="loading__square"></div>
                                    <div class="loading__square"></div>
                                    <div class="loading__square"></div>
                                    <div class="loading__square"></div>
                                    <div class="loading__square"></div>
                                </div>
                            </div>
                            <div>
                                <div class="pending-text">
                                    <h2 class="saving">uploading file<span>.</span><span>.</span><span>.</span>
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()
@push('stack-script')
    @if(isset($items))
        <script>
            $('.delete__confirm').on('click', function (e){
                e.preventDefault();
                
                var form = $(this).data('form-id');
                
                swal({
                    title: "Are you sure?", text: $(this).data('name') + " will be deleted.", icon: "warning", buttons: [true, 'Delete']
                }).then(function (value){
                    if (value) {
                        $('#' + form).submit();
                    }
                });
            })
        </script>
    @endif
    <script>
        const file = {
            allRows: 0, currentRow: 0
        };
        
        var $importButton = $('#import-funeral-homes');
        var $fileInput = $('#fh-excel');
        var $modalButton = $('#fh-import-modal');
        var $cancelImport = $('#cancel-import');
        $body = $("body");
        
        $(document).ready(function (){
            $importButton.on('click', function (e){
                e.preventDefault();
                $fileInput.click();
            });
            
            $fileInput.on('change', function (e){
                $('#funeral-homes').css('display', 'none');
                $('#excel-controls').css('display', 'none');
                $('#pending').css('display', 'inline-block');
                var file = e.target.files[0];
                $body.addClass("loading");
                saveFile(file);
            });
            
            $cancelImport.on('click', function (){
                if (confirm('Are you sure you want to cancel this import?')) {
                    window.importAjax.abort();
                    
                    $(this).before('<div id="loading-counter" class="loading-counter"><p id="canceling-import">Canceling...</p><i class="fa fa-spinner fa-spin" style="font-size:24px"></i></div>');
                    $(this).hide();
                }
            })
        });
        
        function saveFile(file)
        {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            
            var data = new FormData();
            data.append('_token', CSRF_TOKEN);
            data.append('file', file);
            
            $.ajax({
                type: 'POST', url: '{!! route('admin.funeral-home.save-import-file') !!}', processData: false, contentType: false, data: data, success: function (response){
                    $('#funeral-homes').css('display', 'block');
                    $('#excel-controls').css('display', 'block');
                    $('#pending').css('display', 'none');
                    $modalButton.click();
                    window.allRows = response.allRows;
                    window.noLoader = response.noLoader;
                    $('#row-counter').show();
                    if (window.noLoader) {
                        $('#loading-counter').hide();
                        $('#row-counter').html('<div id="loading-counter" class="loading-counter"><span>Loading...</span><p><i class="fa fa-spinner fa-spin" style="font-size:24px"></i></p></div>');
                    }else {
                        $('#row-counter').html('<span id="current-row"></span> of <span id="max-row"></span>');
                        $('#max-row').html(window.allRows);
                        $('#current-row').html(0);
                    }
                    readFile(response.filename);
                }, error: function (response){
                    swal(response.responseJSON.message, "Please try again", "error");
                    $('#funeral-homes').css('display', 'block');
                    $('#excel-controls').css('display', 'block');
                    $('#pending').css('display', 'none');
                }
            });
        }
        
        function readFile(path)
        {
            var interval = window.setInterval(function (){
                $.ajax({
                    type: 'GET', url: '{!! route('admin.funeral-home.get-current-row') !!}', success: function (response){
                        if (!window.noLoader) {
                            $('#current-row').html(response);
                            if (response > 0) {
                                $('#progressbar').css('display', 'block');
                                $('#progressbar-uploading').css('width', (
                                                                             response * 100
                                                                         ) / window.allRows + '%');
                            }
                        }else {
                            $('.loading-counter').remove();
                            $('#row-counter').html('<div id="loading-counter" class="loading-counter"><span id="no-loader">' + response + ' imported</span><p><i class="fa fa-spinner fa-spin" style="font-size:24px"></i></p></div>')
                        }
                    }
                });
            }, 5000);
            
            window.importAjax = $.ajax({
                type: 'GET', url: '{!! route('admin.funeral-home.import') !!}', data: {
                    path: path,
                }, success: function (){
                    clearInterval(interval);
                    $('#progressbar').css('display', 'none');
                    $('#progressbar-uploading').css('width', '0%');
                    $.ajax({
                        type: 'GET', url: '{!! route('admin.funeral-home.get-current-row') !!}', success: function (response){
                            $('#current-row').html(response);
                            $fileInput.val('');
                            swal('Funeral Homes imported successfully', '', "success");
                        }
                    });
                    $('.modal').modal('hide');
                }, error: function (response){
                    if (response.statusText === 'abort') {
                        clearInterval(interval);
                        $('#row-counter').hide();
                        $('#progressbar').css('display', 'none');
                        $('#progressbar-uploading').css('width', '0%');
                        $('.loading-counter').remove();
                        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                        $.ajax({
                            type: 'POST', url: '{!! route('admin.funeral-home.cancel-import') !!}', data: {
                                _token: CSRF_TOKEN,
                            }, success: function (){
                                swal('Funeral homes import canceled', "All imported data has been deleted", "error");
                                $('.modal').modal('hide');
                                $fileInput.val('');
                                $cancelImport.show();
                                $('.loading-counter').remove();
                                $('#canceling-import').remove();
                                $('#no-loader').remove();
                            }
                        });
                    }else {
                        swal(response.responseJSON.message, "Please try again", "error");
                        $('.modal').modal('hide');
                        $fileInput.val('');
                        clearInterval(interval);
                        $cancelImport.show();
                    }
                }
            });
        }
    
    </script>
@endpush
