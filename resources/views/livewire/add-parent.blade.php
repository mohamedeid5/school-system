<div>
    @if (!empty($successMessage))
        <div class="alert alert-success" id="success-alert">
            <button type="button" class="close" data-dismiss="alert">x</button>
            {{ $successMessage }}
        </div>
    @endif

    @if($showTable)
        @include('livewire.parents-table')
    @else

            <button class="btn btn-primary" wire:click="showParentsTable">{{ __('parents.show_parents_table') }}</button>
        <!-- stepwizard -->
    <div class="stepwizard">
        <div class="stepwizard-row setup-panel">
            <div class="stepwizard-step">
                <a href="#step-1" type="button"
                   class="btn btn-circle {{ $currentStep == 1 ? 'btn-success' : 'btn-default' }}">1</a>
                <p>{{ __('parents.step1') }}</p>
            </div>
            <div class="stepwizard-step">
                <a href="#step-2" type="button"
                   class="btn btn-circle {{ $currentStep == 2 ? 'btn-success' : 'btn-default' }}">2</a>
                <p>{{ __('parents.step2') }}</p>
            </div>
            <div class="stepwizard-step">
                <a href="#step-3" type="button"
                   class="btn btn-circle {{ $currentStep == 3 ? 'btn-success' : 'btn-default' }}"
                   disabled="disabled">3</a>
                <p>{{ __('parents.step3') }}</p>
            </div>
        </div>
    </div>

        <!-- includes -->

    @include('livewire.father-form')
    @include('livewire.mother-form')

        <div class="row setup-content {{ $currentStep != 3 ? 'displayNone' : '' }}" id="step-3">
            @if ($currentStep != 3)
                <div style="display: none" class="row setup-content" id="step-3">
                    @endif
                    <div class="col-xs-12">
                        <div class="col-md-12">
                            <h3 style="font-family: 'Cairo', sans-serif;">{{ __('parents.add_parent_attachments') }}</h3>

                            <form wire:submit.prevent="save">
                                <input type="file" wire:model="photos" accept="image/*" multiple>
                            </form>


                            <br><br><br><br><br><br>
                            @if($updateMode)
                                <p>photos</p>
                                @foreach($files as $file)

                                    <button class="btn btn-danger btn-sm" type="button" wire:click="deleteFile('{{ (string) $file->file_name }}', {{ $file->parent_id }})"
                                            >{{ trans('parents.delete') }}</button>

                                    <img src="{{ url('storage/parent_attachments/' . $file->imageable_id . '/' . $file->name) }}" style="width: 10%; height: 10%;">

                                @endforeach
                                <br>
                                <br>

                                <button class="btn btn-success btn-sm btn-lg pull-right" wire:click="submitEditForm"
                                        type="button">{{ trans('parents.finish') }}</button>
                            @else
                                <button class="btn btn-success btn-sm btn-lg pull-right" wire:click="submitForm"
                                        type="button">{{ trans('parents.finish') }}</button>
                            @endif
                            <button class="btn btn-danger btn-sm nextBtn btn-lg pull-right" type="button"
                                    wire:click="back(2)">{{ trans('parents.back') }}</button>
                        </div>
                    </div>
                </div>
        </div>

    @endif

</div>
