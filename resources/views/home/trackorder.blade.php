@extends('layout')


@section('content')

<section style="min-height: 50vh;margin-top:49px;">
    <form action="#" class="d-flex justify-content-center">
        <div class="w-100 d-flex px-3" style="height: 48px;max-width:777px;">
            <input class="m-0 p-0" type="text" placeholder="Enter Order ID" name="name" required />
            <button type="submit" class="btn btn-primary rounded-0 px-4">Track</button>
        </div>
    </form>
</section>

@endsection