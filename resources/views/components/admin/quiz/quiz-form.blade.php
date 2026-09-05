<div>
    <div class="admin-page-header">
        <div>
            <span class="admin-page-eyebrow">
                Management
            </span>

            <h1 class="admin-page-title">
                {{ $quiz ? 'Edit Quiz' : 'Create Quiz' }}
            </h1>

            <p class="admin-page-description">
                {{ $quiz
                    ? 'Update the quiz information below.'
                    : 'Create a new quiz and configure its basic information.'
                }}
            </p>
        </div>
    </div>

    <form wire:submit="save" class="admin-form-card">

        <div class="admin-form-group">
            <label for="title" class="admin-form-label">
                Title
            </label>

            <input
                id="title"
                type="text"
                wire:model="title"
                class="admin-form-input"
                placeholder="Enter quiz title"
            >

            @error('title')
                <span class="admin-form-error">
                    {{ $message }}
                </span>
            @enderror
        </div>

        <div class="admin-form-group">
            <label for="description" class="admin-form-label">
                Description
            </label>

            <textarea
                id="description"
                wire:model="description"
                class="admin-form-textarea"
                rows="5"
                placeholder="Enter quiz description"
            ></textarea>

            @error('description')
                <span class="admin-form-error">
                    {{ $message }}
                </span>
            @enderror
        </div>

        <div class="admin-form-group">
            <label for="status" class="admin-form-label">
                Status
            </label>

            <select
                id="status"
                wire:model="status"
                class="admin-form-select"
            >
                <option value="draft">Draft</option>
                <option value="published">Published</option>
            </select>

            @error('status')
                <span class="admin-form-error">
                    {{ $message }}
                </span>
            @enderror
        </div>

        <div class="admin-form-actions">
            <a
                href="{{ route('admin.quizzes.index') }}"
                class="admin-button admin-button-secondary"
            >
                Cancel
            </a>

            <button
                type="submit"
                class="admin-button admin-button-primary"
                wire:loading.attr="disabled"
            >
                <span wire:loading.remove>
                    {{ $quiz ? 'Update Quiz' : 'Save Quiz' }}
                </span>

                <span wire:loading>
                    Saving...
                </span>
            </button>
        </div>

    </form>
</div>