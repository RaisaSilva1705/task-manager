@extends('layouts.app')

@section('title', 'Meu Perfil - TaskManager')

@section('content')
    <div class="container pb-5">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <h2 class="fs-4 fw-bold mb-4"><i class="bi bi-person-circle text-primary-custom me-2"></i> Meu Perfil</h2>

                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body p-4">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body p-4">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection