@extends('dashboard.layout.app')
@section('content')
<div class="table-responsive scrollbar">
    <table class="table mb-0">
        <thead class="bg-200">
            <tr>
                <th class="text-black dark__text-white align-middle">ID</th>
                <th class="text-black dark__text-white align-middle">Name</th>
                <th class="text-black dark__text-white align-middle">Email Address</th>
                <th class="text-black dark__text-white align-middle">Joined</th>
            </tr>
        </thead>
        <tbody id="bulk-select-body">
            @forelse ($users as $user)
            <tr>
                <td class="align-middle">{{$user->id }}</td>
                <td class="align-middle">{{$user->name }}</td>
                <td class="align-middle">{{$user->email }}</td>
                <td class="align-middle">{{$user->created_at->format('j M Y, g:i a') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="8">No users found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@if ($users->hasPages())
{{ $users->links() }}
@endif
@endsection