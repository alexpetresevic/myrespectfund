@extends('layouts.admin')

@section('content')
    <div class="col-xs-6 col-lg-3">
        <a class="block block-link-hover1" href="{{ route('admin.users.index') }}">
            <div class="block-content block-content-full clearfix">
                <div class="pull-right push-15-t push-15">
                    <i class="fa fa-users fa-2x text-primary"></i>
                </div>
                <div class="h2 text-primary" data-toggle="countTo" data-to="{{ $users }}">{{ $users }}</div>
                <div class="text-uppercase font-w600 font-s12 text-muted">{{ str_plural('User', $users) }}</div>
            </div>
        </a>
    </div>

    <div class="col-xs-6 col-lg-3">
        <a class="block block-link-hover1" href="{{ route('admin.campaigns.index') }}">
            <div class="block-content block-content-full clearfix">
                <div class="pull-right push-15-t push-15">
                    <i class="fa fa-star fa-2x text-primary"></i>
                </div>
                <div class="h2 text-primary" data-toggle="countTo" data-to="{{ $campaigns }}">{{ $campaigns }}</div>
                <div class="text-uppercase font-w600 font-s12 text-muted">{{ str_plural('Fundraiser', $campaigns) }}</div>
            </div>
        </a>
    </div>

    <div class="col-xs-6 col-lg-3">
        <a class="block block-link-hover1" href="{{ route('admin.funeral-homes.index', ['filter' => 'partners']) }}">
            <div class="block-content block-content-full clearfix">
                <div class="pull-right push-15-t push-15">
                    <i class="fa fa-briefcase fa-2x text-primary"></i>
                </div>
                <div class="h2 text-primary" data-toggle="countTo" data-to="{{ $partners }}">{{ $partners }}</div>
                <div class="text-uppercase font-w600 font-s12 text-muted">{{ str_plural('Partner', $partners) }}</div>
            </div>
        </a>
    </div>

    <div class="col-xs-6 col-lg-3">
        <a class="block block-link-hover1" href="{{ route('admin.funeral-homes.index') }}">
            <div class="block-content block-content-full clearfix">
                <div class="pull-right push-15-t push-15">
                    <i class="fa fa-building fa-2x text-primary"></i>
                </div>
                <div class="h2 text-primary" data-toggle="countTo" data-to="{{ $funeralHomes }}">{{ $funeralHomes }}</div>
                <div class="text-uppercase font-w600 font-s12 text-muted">{{ str_plural('Funeral Home', $funeralHomes) }}</div>
            </div>
        </a>
    </div>

    <div class="col-xs-6 col-lg-3">
        <a class="block block-link-hover1" href="{{ route('admin.blog.posts.index') }}">
            <div class="block-content block-content-full clearfix">
                <div class="pull-right push-15-t push-15">
                    <i class="fa fa-thumbtack fa-2x text-primary"></i>
                </div>
                <div class="h2 text-primary" data-toggle="countTo" data-to="{{ $posts }}">{{ $posts }}</div>
                <div class="text-uppercase font-w600 font-s12 text-muted">{{ str_plural('Post', $posts) }}</div>
            </div>
        </a>
    </div>
@endsection
