
@extends('master')

@section('content')

    <link rel="stylesheet" type="text/css" href="{{asset('css/style-scanner.css')}}">
    
    <div class="container">

        <div class="col-md-6 col-md-offset-4">

           @if (session('message'))

                <br>
                <div class="alert alert-danger">

                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                </div>
                
            {{session('message')}}

          

            @endif    
            <form action="{{url('qrcodelogin')}}" method="POST" role="form">
                <input type="hidden" id="send" name="code">
                <div style="position: relative;display: inline-block;">
                <canvas id="qr-canvas" width="320" height="240"></canvas>     
                <div class="scanner-laser laser-rightBottom" style="opacity: 0.5;"></div>
                <div class="scanner-laser laser-rightTop" style="opacity: 0.5;"></div>
                <div class="scanner-laser laser-leftBottom" style="opacity: 0.5;"></div>
                <div class="scanner-laser laser-leftTop" style="opacity: 0.5;"></div> <br>
                {{csrf_field() }}
                <button type="submit" class="submit" class="btn btn-info" style="display: none" ></button>
            </form>   


        </div>
    </div>        

    <script type="text/javascript" src="{{asset('js/DecoderWorker.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/cam/qrcodelib.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/cam/WebCodeCam.js')}}"></script>

    <script type="text/javascript" src="{{asset('js/camera-qrcode.js')}}"></script>

@endsection