
@extends('master')

    @section('content')

        <!-- <script type="text/javascript" src="{{asset('js/custom-qrcode.js')}}"></script> -->

        <div class="container">
            <div class="col-md-6 col-md-offset-4">

                <form action="{{url('qrcodelogin')}}" method="POST" role="form">

                	<h2>Qr-Code Login</h2>
                    <canvas id="canvas"></canvas>
                    <input type="file" id="file-input"><br>
                    <input type="hidden" id="send" name="code">

                	{{ csrf_field() }}

                	<button type="submit" class="btn btn-info">Login</button>
                </form>


                @if (session('message'))

                    <br>
                    <div class="alert alert-danger">

                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{session('message')}}

                    </div>

                @endif
            </div>        
        </div>


@endsection