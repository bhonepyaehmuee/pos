@extends('user.layouts.master')

@section('content')
    <div class=" col-5 offset-4 shadow">
        <h2 class="text-center pt-3">Contact Form</h2>
        @if (session('sendSuccess'))
            <div class="col-12">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fa-solid fa-triangle-exclamation"></i> {{ session('sendSuccess') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif
        <div class="offset-2 col-8 py-4 ">
            <form action="{{ route('user#sendContact') }}" method="post">
                @csrf
                <input class="form-control @error('contactName') is-invalid @enderror" type="text" name="contactName"
                    placeholder="Name">
                @error('contactName')
                    <div class="invalid-feedback"> {{ $message }}</div>
                @enderror

                <input type="email" name="contactEmail"
                    class="form-control mt-3 @error('contactEmail') is-invalid @enderror" placeholder="Email">
                @error('contactEmail')
                    <div class="invalid-feedback"> {{ $message }}</div>
                @enderror

                <textarea name="contactMessage" class="form-control mt-3 @error('contactMessage') is-invalid @enderror" cols="30"
                    rows="10" placeholder="Message"></textarea>
                @error('contactMessage')
                    <div class="invalid-feedback"> {{ $message }}</div>
                @enderror
                <input type="submit" value="Send Message" class="btn btn-warning mt-5 col-5 offset-4 ">
            </form>
        </div>
    </div>
@endsection
