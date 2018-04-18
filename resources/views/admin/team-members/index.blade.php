@extends('layouts.admin')

@section('title', 'Gérer les bénévoles')

@section('content')
    <h2>Bénévoles du val {{ $team->name }}</h2>

    <ul class="team-member-list">
        @foreach ($team->members as $member)
            @php
                $itemClass = '';
                $name = $member->given_name.' '.$member->surname;
                $thisPerson = 'Cette personne peut';

                if (Auth::id() === $member->id) {
                    $itemClass = 'is-me';
                    $name = 'Vous, '.$name;
                    $thisPerson = 'Vous pouvez';
                }
            @endphp
            <li class="{{ $itemClass }}">
                <span class="team-member__fullname">{{ $name }}</span>
                ({{ Html::mailto($member->email, null, ['class' => 'team-member__email']) }})

                @if (count($member->permissions))
                <p>{{ $thisPerson }} :</p>
                <ul class="permission-list">
                    @foreach ($member->permissions as $permission)
                    <li>
                        {{
                            __("permissions.{$permission->name}")
                        }}{{ ($loop->last ? '.' : ' ;') }}
                    </li>
                    @endforeach
                </ul>
                @else
                    <p>Cette personne n’a pas le droit de faire quoi que ce soit !</p>
                @endif

                <a href="{{ route('team-members.edit', $member) }}" class="btn">Modifier</a>
            </li>
        @endforeach
    </ul>
@endsection
