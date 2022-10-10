@php isset($completed) ? $completed = json_decode($completed): $completed=[] @endphp
<nav aria-label="Progress">
    <ol role="list" class="border  border-gray-300 rounded-t-lg divide-y divide-gray-300 md:flex md:divide-y-0">

        <li class="relative md:flex-1 md:flex">
            <!-- Completed Step -->
            <a href="#" class="group flex items-center w-full ">
                        <span class="px-6 py-4 flex items-center text-sm font-medium">
                          <span
                              class="flex-shrink-0 w-10 h-10 flex items-center justify-center {{ ( isset($completed)  && in_array('database',$completed)) ? 'bg-green-400': 'border-2 border-gray-300'}} rounded-full">
                                @if(isset($completed)  && in_array('database',$completed))
                                  <svg class="w-6 h-6 text-white"
                                       xmlns="http://www.w3.org/2000/svg"
                                       viewBox="0 0 20 20"
                                       fill="currentColor"
                                       aria-hidden="true">
                                  <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd"/>
                                </svg>
                              @else
                                  <span
                                      class="flex-shrink-0 w-10 h-10 flex items-center justify-center border-2 {{  ('database'==$current)?'border-green-500':'border-gray-300' }} rounded-full">
                                  <span class="text-gray-500">01</span>
                              </span>
                              @endif
                          </span>
                          <span class="ml-4 text-sm font-medium text-gray-900">Database</span>
                        </span>
            </a>

            <!-- Arrow separator for lg screens and up -->
            <div class="hidden md:block absolute top-0 right-0 h-full w-5" aria-hidden="true">
                <svg class="h-full w-full text-gray-300" viewBox="0 0 22 80" fill="none"
                     preserveAspectRatio="none">
                    <path d="M0 -2L20 40L0 82" vector-effect="non-scaling-stroke" stroke="currentcolor"
                          stroke-linejoin="round"/>
                </svg>
            </div>
        </li>

        <li class="relative md:flex-1 md:flex">
            <!-- Current Step -->
            <a href="#" class="px-6 py-4 flex items-center text-sm font-medium" aria-current="step">
                        <span
                            class="flex-shrink-0 w-10 h-10 flex items-center justify-center {{ ( isset($completed)  && in_array('migration',$completed)) ? 'bg-green-400': 'border-2 border-gray-300'}} rounded-full">
                            @if(isset($completed)  && in_array('migration',$completed))
                            <svg class="w-6 h-6 text-white"
                                 xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 20 20"
                                 fill="currentColor"
                                 aria-hidden="true">
                              <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd"/>
                            </svg>
                            @else
                                <span
                                    class="flex-shrink-0 w-10 h-10 flex items-center justify-center border-2 {{  ('migration'==$current)?'border-green-500':'border-gray-300' }} rounded-full">
                                  <span class="text-gray-500">02</span>
                              </span>
                            @endif
                          </span>
                <span class="ml-4 text-sm font-medium text-500">Migration</span>
            </a>

            <!-- Arrow separator for lg screens and up -->
            <div class="hidden md:block absolute top-0 right-0 h-full w-5" aria-hidden="true">
                <svg class="h-full w-full text-gray-300" viewBox="0 0 22 80" fill="none"
                     preserveAspectRatio="none">
                    <path d="M0 -2L20 40L0 82" vector-effect="non-scaling-stroke"
                          stroke="currentcolor"
                          stroke-linejoin="round"/>
                </svg>
            </div>
        </li>

        <li class="relative md:flex-1 md:flex">
            <!-- Current Step -->
            <a href="#" class="px-6 py-4 flex items-center text-sm font-medium" aria-current="step">
                        <span
                            class="flex-shrink-0 w-10 h-10 flex items-center justify-center {{ ( isset($completed)  && in_array('user',$completed)) ? 'bg-green-400': 'border-2 border-gray-300'}} rounded-full">
                            @if(isset($completed)  && in_array('user',$completed))
                            <svg class="w-6 h-6 text-white"
                                 xmlns="http://www.w3.org/2000/svg"
                                 viewBox="0 0 20 20"
                                 fill="currentColor"
                                 aria-hidden="true">
                              <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd"/>
                            </svg>
                            @else
                                <span
                                    class="flex-shrink-0 w-10 h-10 flex items-center justify-center border-2 {{  ('user'==$current)?'border-green-500':'border-gray-300' }} rounded-full">
                                  <span class="text-gray-500">03</span>
                              </span>
                            @endif
                          </span>
                <span class="ml-4 text-sm font-medium text-500">Admin</span>
            </a>

            <!-- Arrow separator for lg screens and up -->
            <div class="hidden md:block absolute top-0 right-0 h-full w-5" aria-hidden="true">
                <svg class="h-full w-full text-gray-300" viewBox="0 0 22 80" fill="none"
                     preserveAspectRatio="none">
                    <path d="M0 -2L20 40L0 82" vector-effect="non-scaling-stroke"
                          stroke="currentcolor"
                          stroke-linejoin="round"/>
                </svg>
            </div>
        </li>

        <li class="relative md:flex-1 md:flex">
            <!-- Upcoming Step -->
            <a href="#" class="group flex items-center">
                <span class="px-6 py-4 flex items-center text-sm font-medium">
                  <span
                      class="flex-shrink-0 w-10 h-10 flex items-center justify-center {{ ( isset($completed)  && in_array('done',$completed)) ? 'bg-green-400': 'border-2 border-gray-300'}} rounded-full">
                    @if(isset($completed)  && in_array('done',$completed)))
                      <svg class="w-6 h-6 text-white"
                           xmlns="http://www.w3.org/2000/svg"
                           viewBox="0 0 20 20"
                           fill="currentColor"
                           aria-hidden="true">
                      <path fill-rule="evenodd"
                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                            clip-rule="evenodd"/>
                    </svg>
                      @else
                          <span
                              class="flex-shrink-0 w-10 h-10 flex items-center justify-center border-2 {{  ('done'==$current)?'border-green-500':'border-gray-300' }} rounded-full">
                          <span class="text-gray-500">04</span>
                      </span>
                      @endif
                  </span>
                  <span class="ml-4 text-sm font-medium text-900">Done</span>
                </span>
            </a>
        </li>
    </ol>
</nav>
