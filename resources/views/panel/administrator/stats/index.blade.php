@extends('layouts.panel', ['section' => 'stats'])
@section('content')
    <div class="admin-content__header">
        <h2 class="admin-content__title">Статистика</h2>
    </div>
    <div class="admin-content__section">
        <form action="{{ route('panel.tickets.index') }}" method="GET" class="admin-content__filter">
            <div class="admin-content__filter-grid">
                <div class="admin-content__filter-input-block">
                    <label for="" class="admin-content__filter-label">Дата: от</label>
                    <input type="date" name="date_start" value="{{ \Carbon\Carbon::now()->firstOfMonth()->format('Y-m-d') }}" id="date_start" class="input admin-content__filter-input">
                </div>
                <div class="admin-content__filter-input-block">
                    <label for="" class="admin-content__filter-label">Дата: до</label>
                    <input type="date" name="date_end" value="{{ \Carbon\Carbon::now()->addMonth()->firstOfMonth()->format('Y-m-d') }}" id="date_end" class="input admin-content__filter-input">
                </div>
            </div>
            <button type="submit" class="button admin-content__filter-button button--transparent">Найти</button>
        </form>
    </div>
    <div class="admin-content__section">
        <p class="admin-content__section-title">Продажи по каждому дню</p>
        <div class="admin__stats">
            <div class="admin__stats-chart-block">
                <canvas class="stats-chart" id="canvas"></canvas>
            </div>
            <div class="admin__stats-indexes">
                <div class="admin__stats-index">
                    <p class="admin__stats-index-label">Количество продаж</p>
                    <p class="admin__stats-index-value"><span id="tickets_count">0</span></p>
                </div>
                <div class="admin__stats-index">
                    <p class="admin__stats-index-label">Общая выручка</p>
                    <p class="admin__stats-index-value"><span id="price_sum">0</span> руб.</p>
                </div>
{{--                <div class="admin__stats-index">--}}
{{--                    <p class="admin__stats-index-label">Прибыль зала</p>--}}
{{--                    <p class="admin__stats-index-value"><span id="hall_sum">0</span> руб.</p>--}}
{{--                </div>--}}
            </div>
        </div>
    </div>
    <div class="admin-content__section">
        <p class="admin-content__section-title">Продажи по каждому мероприятию</p>
        <div class="stats-chart-block">
            <canvas class="stats-chart" id="canvas2" style="width: 50%"></canvas>
        </div>
    </div>
    <div class="admin-content__section">
        <p class="admin-content__section-title">Продажи по каждому организатору</p>
        <div class="stats-chart-block">
            <canvas class="stats-chart" id="canvas3" style="width: 50%"></canvas>
        </div>
    </div>

{{--    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>--}}
{{--    <script src="{{ asset('js/stats.js') }}"></script>--}}
@endsection

@section('js-files')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('js/stats.js') }}"></script>
@endsection
