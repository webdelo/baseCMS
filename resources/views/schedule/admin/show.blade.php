@extends('app')

@section('content')
    <link rel="stylesheet" href="/css/admin/schedule.css">
    <script src="/js/admin/schedule/schedule.js"></script>
    <script src="/js/admin/schedule/findPatient.js"></script>
    <script src="/js/form.class.js"></script>

    <div class="scheduleContainer" ng-app="scheduleApp">
        <div ui-view></div>
    </div>
@endsection