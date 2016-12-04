<div class="policy-question">
    <div class="pq-text">
        {{ $policy->getTextNoHtml() }}
    </div>
    <div class="pq-buttons">
        <div class="row">
            <div class="col-sm-4 left-np">
                <input type="radio"
                    id="agree_{{ $policy->number }}"
                    name="policy_{{ $policy->number }}"
                    @if(Request::session()->get('policy_' . $policy->number) == 'agree')
                        checked
                    @endif
                    value="agree">
                <label class="agree-label" for="agree_{{ $policy->number }}">
                    Agree
                </label>
            </div>
            <div class="col-sm-4 middle-np">
                <input type="radio"
                    id="dont_know_{{ $policy->number }}"
                    name="policy_{{ $policy->number }}"
                    @if(Request::session()->get('policy_' . $policy->number) == 'dont_know')
                        checked
                    @endif
                    value="dont_know">
                <label class="dont-know-label" for="dont_know_{{ $policy->number }}">
                    Don't know
                </label>
            </div>
            <div class="col-sm-4 right-np">
                <input type="radio"
                    id="disagree_{{ $policy->number }}"
                    name="policy_{{ $policy->number }}"
                    @if(Request::session()->get('policy_' . $policy->number) == 'disagree')
                        checked
                    @endif
                    value="disagree">
                <label class="disagree-label" for="disagree_{{ $policy->number }}">
                    Disagree
                </label>
            </div>
        </div>
    </div>
</div>
