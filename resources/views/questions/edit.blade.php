@extends('base')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Modifier la Question</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('questions.update', $question) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="question_text" class="form-label">Question *</label>
                                <textarea name="question_text" id="question_text" rows="3"
                                          class="form-control @error('question_text') is-invalid @enderror"
                                          required>{{ old('question_text', $question->question_text) }}</textarea>
                                @error('question_text')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="start_date" class="form-label">Date de début</label>
                                    <input type="datetime-local" name="start_date" id="start_date"
                                           class="form-control @error('start_date') is-invalid @enderror"
                                           value="{{ old('start_date', $question->start_date ? $question->start_date->format('Y-m-d\TH:i') : '') }}">
                                    @error('start_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="end_date" class="form-label">Date de fin</label>
                                    <input type="datetime-local" name="end_date" id="end_date"
                                           class="form-control @error('end_date') is-invalid @enderror"
                                           value="{{ old('end_date', $question->end_date ? $question->end_date->format('Y-m-d\TH:i') : '') }}">
                                    @error('end_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Options *</label>
                                <div id="options-container">
                                    @foreach($question->options as $index => $option)
                                        <div class="option-group mb-2">
                                            <div class="input-group">
                                                <input type="text" name="options[]"
                                                       class="form-control @error('options.' . $index) is-invalid @enderror"
                                                       value="{{ old('options.' . $index, $option->option_text) }}"
                                                       placeholder="Option {{ $index + 1 }}" required>
                                                <button type="button" class="btn btn-danger remove-option"
                                                    {{ $index < 2 ? 'disabled' : '' }}>
                                                    <i class="fa fa-times"></i>
                                                </button>
                                                @error('options.' . $index)
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <button type="button" id="add-option" class="btn btn-sm btn-secondary mt-2">
                                    <i class="fa fa-plus"></i> Ajouter une option
                                </button>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('questions.index') }}" class="btn btn-secondary">
                                    <i class="fa fa-arrow-left"></i> Retour
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-save"></i> Mettre à jour
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const optionsContainer = document.getElementById('options-container');
            const addOptionBtn = document.getElementById('add-option');

            addOptionBtn.addEventListener('click', function() {
                const optionCount = optionsContainer.querySelectorAll('.option-group').length;
                const newOption = document.createElement('div');
                newOption.className = 'option-group mb-2';
                newOption.innerHTML = `
                    <div class="input-group">
                        <input type="text" name="options[]" class="form-control"
                               placeholder="Option ${optionCount + 1}" required>
                        <button type="button" class="btn btn-danger remove-option">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                `;
                optionsContainer.appendChild(newOption);

                // Activer le bouton de suppression pour tous les éléments sauf les deux premiers
                const removeButtons = optionsContainer.querySelectorAll('.remove-option');
                removeButtons.forEach((btn, index) => {
                    btn.disabled = index < 2;
                });
            });

            optionsContainer.addEventListener('click', function(e) {
                if (e.target.classList.contains('remove-option') ||
                    e.target.closest('.remove-option')) {
                    const optionGroup = e.target.closest('.option-group');
                    if (optionGroup && optionsContainer.querySelectorAll('.option-group').length > 2) {
                        optionGroup.remove();
                    }
                }
            });
        });
    </script>
@endsection
