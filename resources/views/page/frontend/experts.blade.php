@extends('homepage.layout.home')
@section('content')

    <main class="page-category-experts">

        {!! htmlBreadcrumb(0) !!}

        <section class="list-experts wow fadeInUp">
            <div class="container">
                <div class="teams-list-filter">
                    <a class="teams-filter-collapse" role="button" data-toggle="collapse" href="javascript:void(0)" onclick="showFilter()" aria-expanded="false">Bộ lọc</a>
                    <div class="teams-filter-content" id="teams-filter">
                        <div class="form">
                            <div class="row">
                                @if (isset($listAttribute) && count($listAttribute))
                                    @foreach ($listAttribute as $k => $cat)
                                        <div class="col-md-12 col-12 col-lg-3 filter-item form-group">
                                            <select class="form-control select2">
                                                <option value="" selected="selected">Chọn {{ $cat->title }}</option>
                                                @if (isset($cat->listAttr) && count($cat->listAttr))
                                                    @foreach ($cat->listAttr as $kc => $attr)
                                                        <option @if (in_array($attr->id, $filters)) selected @endif
                                                            value="{{ $attr->id }}">{{ $attr->title }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    @endforeach
                                @endif
                                <div class="col-md-12 col-12 col-lg-3 filter-item actions">
                                    <form>
                                        <input type="hidden" name="filters" value="{{ request()->filters }}"
                                            id="filters">
                                        <button type="submit" class="btn btn-primary btn_TimKiem">Tìm kiếm bác sĩ</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    @if (isset($data))
                        @foreach ($data as $v)
                            <div class="col-lg-3 col-md-4 wow fadeInUp">{!! htmlItemMember($v) !!}</div>
                        @endforeach
                        <div class="col-lg-12 wow fadeInUp">{!! $data->links() !!}</div>
                    @else
                        <div class="col-lg-12 wow fadeInUp"></div>
                    @endif
                </div>
            </div>
        </section>

        @include('homepage.common.serveice')

    </main>



@endsection

@push('css')
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('frontend/css/select2.min.css') }}" />
@endpush

@push('javascript')
    <script src="{{ asset('frontend/js/select2.min.js') }}"></script>
    <script>
        $('select').select2({});
        $('select').change(function() {
            var attr = []
            $('select').each(function() {
                if ($(this).val() != '') {
                    attr.push($(this).val());
                }
            })
            $('#filters').val(attr.join('-'));
        })

        function activeSeclect2() {
            let attr = ''
        }

        function showFilter() {
            $('.teams-filter-content').slideToggle();
        }
    </script>
@endpush
