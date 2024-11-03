  <div
      class="min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-0 flex justify-center items-center inset-0 z-50 outline-none focus:outline-none bg-no-repeat bg-center bg-cover">
      <div class="absolute bg-black opacity-80 inset-0 z-0"></div>
      <div class="w-full  max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white ">
          <!--content-->
          <div class="">
              <!--body-->
              <div class="text-center p-5 flex-auto justify-center">
                  <form>
                      <div class="grid gap-6 mb-6 md:grid-cols-2">
                          <div>
                              <label for="title"
                                  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title
                              </label>
                              <input type="text" id="title"
                                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                  placeholder="Web Developer" required />
                              <p class="mt-2 text-xs text-red-600 dark:text-red-500"><span class="font-medium"></span>
                              </p>
                          </div>

                          <div>
                              <label for="salary"
                                  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Salary</label>
                              <input type="text" id="salary"
                                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                  placeholder="40,000 - 50,000 Tk" required />
                          </div>

                          <div>
                              <label for="location"
                                  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Location</label>
                              <input type="text" id="location"
                                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                  placeholder="Dhaka, Bangladesh" required />
                          </div>

                          <div>
                              <label for="url"
                                  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Url</label>
                              <input type="text" id="url"
                                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                  placeholder="http://padberg.com/" required />
                          </div>

                          <div>
                              <label for="schedule"
                                  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Schedule</label>
                              <select id="schedule"
                                  class="block w-full p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500">
                                  <option selected>Select an option</option>
                                  <option value="US">United States</option>
                                  <option value="CA">Canada</option>
                              </select>
                          </div>

                          <div>
                              <label for="featured"
                                  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Featured</label>
                              <select id="featured"
                                  class="block w-full p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500">
                                  <option selected>Select an option</option>
                                  <option value="US">United States</option>
                                  <option value="CA">Canada</option>
                              </select>
                          </div>

                          <div>
                              <label for="status"
                                  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                              <select id="status"
                                  class="block w-full p-2 mb-6 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500">
                                  <option selected>Select an option</option>
                                  <option value="US">United States</option>
                                  <option value="CA">Canada</option>
                              </select>
                          </div>

                      </div>

                      <button type="submit"
                          class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center ">Update</button>
                  </form>

              </div>
              <!--footer-->
              <div class="p-2 mt-2 flex justify-between">
                  <p>Edit Job</p>

                  <button wire:click="closeModal()"
                      class="mb-2 md:mb-0 bg-yellow-400 border border-yellow-400 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-yellow-500">Cancel</button>

              </div>
          </div>
      </div>
  </div>
