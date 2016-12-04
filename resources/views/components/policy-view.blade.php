<div class="policy">
    <p class="text-center">{!! $policy_position->getPolicy()->text !!}</p>
    <h2 class="text-center policy-text">{{ $policy_position->getPositonText() }}</h2>
    <div class="agreement-bar">
        <span class="bar-text-right bar-text">agrees</span>
        <div class="disagreement">
            <span class="bar-text">disagrees</span>
            <div class="disagreement-grey" style="width: {{ (50 - $policy_position->getDisagreement())*2 }}%">
            </div>
        </div><div class="agreement" style="width: {{ $policy_position->getAgreement() }}%"></div>
    </div>
</div>
