<x-app-layout>
  @slot('title', 'Create Events')

  <x-slot name="header">
    <h2 class="tw-font-semibold tw-text-xl tw-text-gray-800 tw-leading-tight">
      Create Event
    </h2>
  </x-slot>
  <x-container>

    <x-card>
      @if($progress)
      <x-progress-create-event step='2' />
      @endif
      <x-card.header>
        <x-card.title>{{ 'Question '. $event->title }} </x-card.title>
        <x-card.description>Create question for event</x-card.description>
      </x-card.header>
      <x-card.content>
        <x-bladewind::button size="small" onclick="showModal('create-question')">
          Create Question
        </x-bladewind::button>
        <x-table>
          <x-table.thead>
            <tr>
              <x-table.th>No</x-table.th>
              <x-table.th>Question</x-table.th>
              <x-table.th>Action</x-table.th>
            </tr>
          </x-table.thead>
          <x-table.tbody>
            @foreach ($questions as $question)
            <tr>
              <x-table.td>{{ $loop->iteration }}</x-table.td>
              <x-table.td>{{ $question->question }}</x-table.td>
              <x-table.td>
                <x-bladewind::button size="tiny" outline="true"
                  onclick="showUpdateModal({{ $question->id }}, '{{ $question->question }}')">
                  Update
                </x-bladewind::button>
                {{-- Delete --}}

                <form action="{{ route('events.questions.destroy', $question) }}" method="POST" class="tw-inline">
                  @csrf
                  @method('delete')
                  <x-bladewind::button can_submit="true" size="tiny" outline="true">
                    Delete
                  </x-bladewind::button>
                </form>
              </x-table.td>
            </tr>
            @endforeach
          </x-table.tbody>
        </x-table>
      </x-card.content>
      <x-card.footer class="tw-flex tw-justify-end">
        <a href="{{ route('events.status',$event) }}">
          <x-primary-button>
            Next
          </x-primary-button>
        </a>
      </x-card.footer>
    </x-card>

    <!-- Modal Create Question -->
    <x-bladewind::modal ok_button_action="saveQuestion()" size="big" name="create-question" title="Create Questions"
      blur_size="none" ok_button_label="Create" close_after_action="false">
      <form id="form-question-event" action={{ Route('events.questions.store', $event) }} class="tw-space-y-3"
        method="POST">
        @method('post')
        @csrf
        <div id="questions">
          <x-bladewind::input required="true" name="question" error_message="Please enter your Question"
            label="Question" autofocus="true" />
          <x-input-error class="tw-mt-2" :messages="$errors->get('question')" />
        </div>
      </form>
    </x-bladewind::modal>

    <!-- Modal Update Question -->
    <x-bladewind::modal ok_button_action="updateQuestion()" size="big" name="update-question" title="Update Question"
      blur_size="none" ok_button_label="Update" close_after_action="false">
      <form id="form-update-question" action="" class="tw-space-y-3" method="POST">
        @method('PUT')
        @csrf
        <div id="update-questions">
          <x-bladewind::input required="true" name="question" error_message="Please enter your Question"
            label="Question" />
          <x-input-error class="tw-mt-2" :messages="$errors->get('question')" />
        </div>
      </form>
    </x-bladewind::modal>

  </x-container>

  <x-slot name="scripts">
    <script>
      saveQuestion = () => {
        if(validateForm('#form-question-event')){
            domEl('#form-question-event').submit();
        } else {
            return false;
        }

      }

      showUpdateModal = (id, question) => {
        const form = domEl('#form-update-question');
        form.action = `/questions/${id}`;
        form.querySelector('input[name="question"]').value = question;
        showModal('update-question');
      }

      updateQuestion = () => {
        if(validateForm('#form-update-question')){
            domEl('#form-update-question').submit();
        } else {
            return false;
        }
      }

    </script>
  </x-slot>

</x-app-layout>