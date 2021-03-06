@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-users fa-lg fa-fw" aria-hidden="true"></i>
                        &nbsp;
                        Teams {{ $clients->total() }}
                    </div>

                    <div class="card-body">

                        <!-- Filters -->
                        @include('clients.partials.filters')

                        <!-- Client List -->
                        @each('clients.partials.client', $clients, 'client', 'clients.partials.empty')

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center">
                            {{ $clients->appends($_GET)->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
