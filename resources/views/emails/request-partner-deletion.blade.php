Partenaire :
{{ $partner->name }} (ID : {{ $partner->id }})
(créé le {{ $partner->created_at->format('d/m/Y à H:i') }})
@if ($partner->isValidated())
⚠️  Ce partenaire est validé
@endif

{{ route('partners.add.summary', $partner) }}

Raison(s) :
{{ $reason }}

Demande de :
{{ $teamMember->given_name }} {{ $teamMember->surname }} ({{ $teamMember->team->name }})
{{ $teamMember->email }}
