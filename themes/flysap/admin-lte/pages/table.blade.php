@extends('themes::layouts.default')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">{{$title}}</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        {!! $table->render() !!}
                        {!! Parfumix\TableManager\render_pagination($table) !!}

                        @if(isset($addRoute))
                            <a href="{{$addRoute}}">{{trans('add new')}}</a>
                        @endif
                    </div><!-- /.box-body -->
                </div><!-- /.box -->

            </div><!-- /.col -->
        </div><!-- /.row -->
    </section><!-- /.content -->
@endsection