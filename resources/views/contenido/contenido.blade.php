    @extends('principal')
    @section('contenido')
        @if(Auth::user()->idrol == 1)

      
            <template v-if="menu==0">
                <empresa></empresa>
            </template>

            <template v-if="menu==1">
                <empleado></empleado>
            </template>

           

        @endif

        
        
    @endsection