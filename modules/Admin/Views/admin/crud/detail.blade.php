@extends('admin.layouts.app')



@section('content')

    <form action="{{route('page.admin.store',['id'=>($row->id) ? $row->id : '-1','lang'=>request()->query('lang')])}}" method="post">

        @csrf

        <div class="container">

            <div class="d-flex justify-content-between mb20">

                <div class="">

                    <h1 class="title-bar">{{$row->id ? __('Edit: ') .$translation->title :  __('Add new page') }}</h1>

                    @if($row->slug && $row->slug_page_name)
                        <p class="item-url-demo">
                            {{ __('Permalink: ')}} {{ url((request()->query('lang') ? request()->query('lang').'/' : ''). config('page.directory_route_prefix') )}}/<a href="#" class="open-edit-input" data-name="slug_page_name">{{$row->slug_page_name}}</a>/<a href="#" class="open-edit-input" data-name="slug">{{$row->slug}}</a>
                        </p>
                    @endif

                </div>

                <div class="">

                    @if($row->slug && $row->slug_page_name)

                        <a class="btn btn-primary btn-sm" href="{{$row->getDetailUrl(request()->query('lang'))}}" target="_blank">{{ __('View directory')}}</a>

                    @endif

                </div>

            </div>

            @include('admin.message')

            @if($row->id)

                @include('Language::admin.navigation')

            @endif

            <div class="lang-content-box">

                <?php \Modules\Admin\Crud::layout($crudModule,$layouts) ?>

            </div>

        </div>

    </form>

@endsection

@section ('script.body')

@endsection

