@extends('frontend.layouts.main')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"> </script>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" />
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="js/scripts.js"></script>

@section('content')
<div class="container">
        <div class="col-md-10 col-md-offset-2">
            <div class="breadcrumbs">
                <ul>
                    <li class="breadcrumbs-separator"></li>
                    <li class="current">Your estimates!</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container" >
        <div class="row">
            @include('frontend.blocks.left-menu')
            <?php $id = 1;?>
            <div class="page-main-content col-xs-12 col-md-10" align="middle" >
                <div class="row" style="margin-right: 20px;">
                    <div >
                        <div class="about-lori">
                        <h2> Estimates history</h2>
                        <table class=" display nowrap dataTable dtr-inline" style="width: 90%;" id="myTable">
                        <thead>
                            <tr class="headTable">
                                <th>Estimate</th>
                                <th>Completed</th>
                                <th>Status</th>
                                <th>Created at</th>
                                <th>Updated at</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody >
                        @foreach ($estimates as $estimate)
                        <tr data-toggle="collapse" data-target="#collapse4039" class="clickable">
                            <td >{{ $id }}</td>

                            @if($estimate['text']->completed == 1)
                                <td>Yes</td>
                            @else
                                <td>No</td>
                            @endif
                            @php
                                switch($estimate['text']->status){
                                case 0:
                                    echo "<td>Pending</td>";
                                    break;
                                case 1:
                                    echo "<td>Canceled</td>";
                                    break;
                                case 2:
                                    echo "<td>Contacted</td>";
                                    break;
                                case 3:
                                    echo "<td>Finished</td>";
                                    break;
                                case 4:
                                    echo "<td>Not completed</td>";
                                    break;
                                default:
                                    break;
                            }
                            @endphp

                            <td>{{ $estimate['text']->created_at }}</td>
                            <td>{{ $estimate['text']->updated_at }}</td>
                            <td style="text-align: center;">
                            <div class="btn-group btn-group-sm" role="group" aria-label="...">
                              <div class="btn-group " aria-label="Imprimer la liste d'emargement pour cette formation">
                                <a href="{{ route('estimate.history', $estimate['text']->id) }}" target="_blank">
                                <span class="glyphicon glyphicon-download-alt" aria-hidden="true" style="color:black; margin: 5px;"></span>
                                </a>
                              </div>
                            </div>
                            </td>
                        </tr>
                        <?php $id += 1;?>
                        @endforeach
                        </tbody>
                        </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
<!-- <style type="text/css">
    #myTable_filter {
        display: none;
    }
    .dataTables_length {
        display: none;
    }
    @media only screen and (max-width: 500px) {
        table {
            font-size: 12px;
        }
    }
</style> -->