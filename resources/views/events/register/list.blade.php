<x-app-layout>
  @slot('title', 'My Events')

  <x-slot name="header">
    <h2 class="tw-font-semibold tw-text-xl tw-text-gray-800 tw-leading-tight">
      {{ __('My Events') }}
    </h2>
  </x-slot>

  <x-container>
    <x-alert-status />
    <x-card>
      <x-card.header>
        <x-card.title>List Register Event</x-card.title>
        <x-card.description>
          <div class="tw-sm:flex tw-sm:items-center">
            <p class="tw-sm:flex-auto tw-mt-2 tw-text-sm tw-text-gray-700">
              A list of all the users in your account including their name, title, email, role, and answers.
            </p>
          </div>
        </x-card.description>
        <x-card.content>
          <x-table>
            <x-table.thead>
              <tr>
                <x-table.th>Name</x-table.th>
                <x-table.th>Email</x-table.th>
                <x-table.th>Phone</x-table.th>
                <x-table.th>Status</x-table.th>
                <x-table.th>Register Date</x-table.th>
                <x-table.th>Action</x-table.th>
              </tr>
            </x-table.thead>
            <x-table.tbody>
              @foreach ($registerEvent as $user)
              <tr>
                <x-table.td>{{ $user->name }}</x-table.td>
                <x-table.td>{{ $user->email }}</x-table.td>
                <x-table.td>{{ optional($user->userDetail)->phone ?? 'N/A' }}</x-table.td>

                {{-- <x-table.td>
                  <x-bladewind::button size="tiny" outline="true"
                    onclick="showDetailModal({{ $user->id }}, '{{ json_encode($user) }}')">
                    Detail
                  </x-bladewind::button>
                </x-table.td>
                <x-table.td>
                  <x-bladewind::button size="tiny" outline="true"
                    onclick="showAnswerModal({{ $user->id }}, '{{ json_encode($user->answers) }}')">
                    View Answers
                  </x-bladewind::button>
                </x-table.td> --}}
                @php
                $status = $user->pivot->user_acceptance_status;
                @endphp
                <x-table.td>
                  <p
                    class="tw-text-{{ $status == 'pending' ? 'yellow' : ($status == 'accepted' ? 'green' : 'red') }}-500">
                    {{ ucfirst($status) }}
                  </p>
                </x-table.td>
                <x-table.td>{{ \Carbon\Carbon::parse($user->created_at)->format('d-M-Y') }}</x-table.td>
                <x-table.td>
                  <a href="{{ route('events.register.show', [$event, $user]) }}">
                    <x-bladewind::button size="tiny" outline="true">
                      Detail
                    </x-bladewind::button>
                  </a>
                </x-table.td>
              </tr>
              @endforeach
            </x-table.tbody>
          </x-table>
        </x-card.content>
      </x-card.header>
    </x-card>

    {{--
    <!-- Detail Modal -->
    <x-bladewind::modal size="big" name="detail_user" title="Detail User" blur_size="none" ok_button_label="Close"
      close_after_action="false">
      <div id="detail">
        <table>
          <tr>
            <td>Name</td>
            <td>:</td>
            <td id="name"></td>
          </tr>
          <tr>
            <td>Email</td>
            <td>:</td>
            <td id="email"></td>
          </tr>
          <tr>
            <td>Role</td>
            <td>:</td>
            <td id="role"></td>
          </tr>
        </table>
      </div>
    </x-bladewind::modal>

    <!-- Answer Modal -->
    <x-bladewind::modal size="big" name="answer_modal" title="User Answers" blur_size="none" ok_button_label="Close"
      close_after_action="false">
      <div id="answers">
        <ul id="answer_list">
          <!-- Dynamically filled with answers -->
        </ul>
      </div>
    </x-bladewind::modal> --}}
  </x-container>

  {{-- <x-slot name="scripts">
    <script>
      const showDetailModal = (id, userJson) => {
        const user = JSON.parse(userJson);

        const detailContainer = document.querySelector('#detail');
        detailContainer.querySelector('#name').innerText = user.name || 'N/A';
        detailContainer.querySelector('#email').innerText = user.email || 'N/A';
        detailContainer.querySelector('#role').innerText = user.role || 'N/A';

        showModal('detail_user');
      };

      const showAnswerModal = (id, answersJson) => {
        const answers = JSON.parse(answersJson);

        const answerList = document.querySelector('#answer_list');
        answerList.innerHTML = ''; // Clear previous answers

        if (answers.length > 0) {
          answers.forEach((answer, index) => {
            const li = document.createElement('li');
            li.innerText = `${index + 1}. ${answer.question}: ${answer.answer}`;
            answerList.appendChild(li);
          });
        } else {
          const li = document.createElement('li');
          li.innerText = 'No answers available.';
          answerList.appendChild(li);
        }

        showModal('answer_modal');
      };
    </script>
  </x-slot> --}}
</x-app-layout>