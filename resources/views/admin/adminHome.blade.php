@extends('layouts.app')

@section('content')
        <!-- Main Content -->
            <div class="container-fluid">
                <section class="row">
                    <article class="col-lg-4 col-6">
                        <section class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ number_format($total_users) }}</h3>
                                <p>Total Users</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-users"></i>
                            </div>
                        </section>
                    </article>

                    <article class="col-lg-4 col-6">
                        <section class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ number_format($total_orders) }}</h3>
                                <p>Total Orders</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-box"></i>
                            </div>
                        </section>
                    </article>

                    <article class="col-lg-4 col-6">
                        <section class="small-box bg-warning">
                            <div class="inner">
                                <h3>Rp. {{ number_format($total_revenue, 2) }}</h3>
                                <p>Total Revenue</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-money-bill-alt"></i>
                            </div>
                        </section>
                    </article>
                </section>
        </div>
    </div>
@endsection
