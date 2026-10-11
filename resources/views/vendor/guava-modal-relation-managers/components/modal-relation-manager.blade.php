@props([
    'ownerRecord',
    'relationManager',
    'shouldHideRelationManagerHeading' => true,
])

<div @class([
    "-mx-6 [&_.fi-ta-ctn]:![box-shadow:none]",
    "[&_.fi-ta-header-heading]:hidden" => $shouldHideRelationManagerHeading,
])>
    @livewire($relationManager, ['ownerRecord' => $ownerRecord])
</div>
