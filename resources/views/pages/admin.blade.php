@extends('layouts.app')
@section('page-title', 'Admin')

@section('content')

    <div id="admin_div" class="mt-5">
        @include('partials.header')

        <h2> New Tags Proposals </h2>

        <h4>Pending Tags</h4>

        @each('partials.tag_proposal', $tag_proposals, 'tag_proposal')

        <h4>Accepted Tags</h4>

        @each('partials.tag_proposal', $accepted_tag_proposals, 'tag_proposal')


        <button id="delete_button" class="width-25 btn btn-primary rounded-pill text-light" data-bs-toggle="modal" data-bs-target="#revokeModal-{{ Auth::user()->id }}">Revoke Admin</button>
    </div>
@endsection

<!-- Modal -->
<div class="modal fade" id="revokeModal-{{ Auth::user()->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <p>Are you sure you want to <b>permanently</b> revoke your admin privileges?</p>
                <p>This action is <b>irreversible</b>.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary fw-bold text-light" data-bs-dismiss="modal">Close</button>
                <form id="delete_form" method="POST" action="{{route('revoke', Auth::user()->id)}}">
                    {{ csrf_field() }}
                    <button type="submit" id="delete_confirm" class="btn btn-primary fw-bold" > Confirm Revoke </button>
                </form>
            </div>
        </div>
    </div>
</div>