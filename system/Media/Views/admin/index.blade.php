@extends('media::admin.layouts.app')

@section('body')
    <div id="media" class="mdl-grid">
        <template v-for="m in media">
            <div class="mdl-cell mdl-cell--3-col mdl-card mdl-shadow--2dp" style="background: url(@{{ m.item.url }}) center / cover;">
                <div class="mdl-card__title mdl-card--expand"></div>
                <div class="mdl-card__actions">
                    <span class="demo-card-image__filename">@{{ m.name }}</span>
                </div>
                <div class="mdl-card__menu">
                    <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon" id="card-menu-@{{ $index }}">
                        <i class="material-icons">more_vert</i>
                    </button>

                    <ul class="mdl-menu mdl-js-menu mdl-menu--bottom-right" for="card-menu-@{{ $index }}">
                        <li class="mdl-menu__item" data-id="@{{ $index }}" v-on:click="edit($index)">Edit</li>
                        <li class="mdl-menu__item" data-id="@{{ $index }}">Remove</li>
                    </ul>
                </div>
            </div>
        </template>

        <dialog id="dialog" class="mdl-dialog mdl-cell--3-col">
            <div class="mdl-dialog__content">
                <div class="mdl-textfield mdl-js-textfield">
                    <input class="mdl-textfield__input" type="text" v-model="mediaItem.name">
                </div>
                <div class="mdl-textfield mdl-js-textfield">
                    <textarea class="mdl-textfield__input" type="text" v-model="mediaItem.description"></textarea>
                </div>
                <div class="mdl-textfield mdl-js-textfield">
                    <input class="mdl-textfield__input" type="text" v-model="mediaItem.folder">
                </div>
            </div>
            <div class="mdl-dialog__actions">
                <button type="button" class="mdl-button" v-on:click="saveMediaItem">Save</button>
                <button type="button" class="mdl-button close" v-on:click="closeDialog">Cancel</button>
            </div>
        </dialog>

    </div>



@endsection


@push('scripts')
    <script src="{{ elixir('assets/vendor/vue/vue-all.js') }}"></script>

    <script>

        /*
         get: {method: 'GET'},
         save: {method: 'POST'},
         query: {method: 'GET'},
         update: {method: 'PUT'},
         remove: {method: 'DELETE'},
         delete: {method: 'DELETE'}
         */

        new Vue({
            el: '#media',
            data: {
                media: [],
                mediaItem: {}
            },

            ready: function() {

                var resource = this.$resource(window.location.href+'/api/');

                // get item
                resource.get().then(function (response) {
                    this.$set('media', response.data.media);
                    setTimeout(function(){
                        componentHandler.upgradeDom();
                    }, 1);
                });

            },
            methods: {
                edit: function(index) {
                    this.mediaItem = this.media[index];
                    console.log(this.mediaItem);
                    var dialog = document.querySelector('dialog');
                    dialog.showModal();

                },

                closeDialog: function() {
                    var dialog = document.querySelector('dialog');
                    dialog.close();
                    this.mediaItem = {};
                }
            }
        })
    </script>
@endpush