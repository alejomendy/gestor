<?php

namespace App\Filament\Resources\DeclaracionJurada\Schemas;

use App\Models\Worker;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Html;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Schema;

class DeclaracionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Wizard::make([

                
                Step::make('Inicio')
                    ->icon('heroicon-o-document-check')
                    ->schema([
                        Section::make()
                            ->schema([
                                Html::make(new \Illuminate\Support\HtmlString('
                                    <div style="text-align: center; border-bottom: 2px solid #eee; margin-bottom: 20px; padding-bottom: 20px;">
                                        <h2 style="font-weight: bold; font-size: 1.2rem; margin: 0; color: #333;">MUNICIPALIDAD DE RÍO CUARTO</h2>
                                        <h3 style="font-weight: bold; font-size: 1rem; margin: 5px 0; color: #666;">ORDENANZA N° 747/98</h3>
                                        <h1 style="font-weight: bold; font-size: 1.5rem; margin: 10px 0; letter-spacing: 1px; color: #000;">DECLARACIÓN JURADA PRIVADA</h1>
                                    </div>
                                ')),

                                Html::make('
                                    <p style="text-align: center; font-style: italic; color: #666;">
                                        Esta declaración debe ser completada con carácter de absoluta reserva conforme a la normativa vigente.
                                    </p>
                                '),
                            ]),
                    ]),

                
                Step::make('I. DATOS PERSONALES Y FAMILIARES')
                    ->icon('heroicon-o-user')
                    ->schema([
                        Section::make('DATOS PERSONALES DEL DECLARANTE')
                            ->schema([
                                Select::make('worker_id')
                                    ->label('Apellido y Nombre')
                                    ->options(
                                        Worker::query()
                                            ->orderBy('last_name')
                                            ->get()
                                            ->mapWithKeys(fn($w) => [$w->id => $w->last_name . ', ' . $w->name])
                                    )
                                    ->searchable()
                                    ->required()
                                    ->default(request()->query('worker_id'))
                                    ->live()
                                    ->columnSpan(1),

                                TextInput::make('dni_placeholder')
                                    ->label('Documento de Identidad')
                                    ->placeholder(fn($get) => Worker::find($get('worker_id'))?->dni ?? '')
                                    ->disabled()
                                    ->dehydrated(false)
                                    ->columnSpan(1),

                                TextInput::make('legajo')
                                    ->label('N° de Legajo')
                                    ->maxLength(50),

                                TextInput::make('ci_numero')
                                    ->label('D.N.I°')
                                    ->maxLength(20),

                                TextInput::make('ci_expedida_por')
                                    ->label('Expedida por')
                                    ->maxLength(100),

                                Select::make('estado_civil')
                                    ->label('Estado Civil')
                                    ->options([
                                        'soltero' => 'Soltero/a',
                                        'casado' => 'Casado/a',
                                        'divorciado' => 'Divorciado/a',
                                        'viudo' => 'Viudo/a',
                                        'union' => 'Unión convivencial',
                                    ]),

                                TextInput::make('profesion')
                                    ->label('Profesión')
                                    ->maxLength(100),

                                TextInput::make('domicilio')
                                    ->label('Domicilio')
                                    ->maxLength(255)
                                    ->columnSpanFull(),
                            ])
                            ->columns(2),

                        Section::make('DATOS DEL CÓNYUGE E HIJOS MENORES')
                            ->schema([
                                Repeater::make('familiares')
                                    ->label('')
                                    ->relationship('familiares')
                                    ->schema([
                                        TextInput::make('apellido_nombres')
                                            ->label('Apellido y Nombres')
                                            ->maxLength(255)
                                            ->columnSpan(2),
                                        TextInput::make('parentesco')
                                            ->label('Parentesco')
                                            ->maxLength(50),
                                        Group::make([
                                            Select::make('doc_tipo')
                                                ->label('Tipo Doc.')
                                                ->options([
                                                    'DNI' => 'DNI',
                                                    'Pasaporte' => 'Pasaporte',
                                                    'LC' => 'LC',
                                                    'LE' => 'LE',
                                                    'CI' => 'CI',
                                                ]),
                                            TextInput::make('doc_numero')
                                                ->label('Número')
                                                ->maxLength(30),
                                        ])
                                            ->columns(2)
                                            ->columnSpan(2),
                                    ])
                                    ->columns(5)
                                    ->addActionLabel('Agregar familiar')
                                    ->columnSpanFull(),
                            ]),
                    ]),

                
                Step::make('II. DETALLE DE LOS BIENES')
                    ->icon('heroicon-o-home')
                    ->schema([
                        Section::make('1. BIENES INMUEBLES')
                            ->schema([
                                Repeater::make('bienesInmuebles')
                                    ->label('')
                                    ->relationship('bienesInmuebles')
                                    ->schema([
                                        TextInput::make('tipo')
                                            ->label('Tipo')
                                            ->maxLength(100),
                                        TextInput::make('ubicacion')
                                            ->label('Ubicación')
                                            ->maxLength(255),
                                        TextInput::make('inscripcion_catastral')
                                            ->label('Inscripción Regional o Nomencl. Catastral')
                                            ->maxLength(255),
                                        TextInput::make('porcentaje_propiedad')
                                            ->label('% sobre la propiedad')
                                            ->maxLength(10),
                                        DatePicker::make('fecha_ingreso')
                                            ->label('Fecha Ingreso al patrimonio')
                                            ->native(false),
                                        Group::make([
                                            TextInput::make('valuacion_fiscal_importe')
                                                ->label('Última Val. Fiscal — Importe')
                                                ->numeric()
                                                ->prefix('$'),
                                            TextInput::make('valuacion_fiscal_anio')
                                                ->label('Año')
                                                ->numeric(),
                                        ])->columns(2),
                                    ])
                                    ->columns(2)
                                    ->addActionLabel('Agregar inmueble')
                                    ->columnSpanFull(),
                            ]),

                        Section::make('2. BIENES MUEBLES REGISTRABLES: automotores, naves, aeronaves, yates, motocicletas y similares')
                            ->schema([
                                Repeater::make('bienesMuebles')
                                    ->label('')
                                    ->relationship('bienesMuebles')
                                    ->schema([
                                        TextInput::make('tipo')
                                            ->label('Tipo')
                                            ->maxLength(100),
                                        TextInput::make('descripcion')
                                            ->label('Descripción: marca, modelo')
                                            ->maxLength(255),
                                        TextInput::make('nro_patente_matricula')
                                            ->label('N° Patente o Matrícula')
                                            ->maxLength(50),
                                        TextInput::make('porcentaje_propiedad')
                                            ->label('% sobre la propiedad')
                                            ->maxLength(10),
                                        DatePicker::make('fecha_ingreso')
                                            ->label('Fecha Ingreso al patrimonio')
                                            ->native(false),
                                        TextInput::make('valuacion_actualizada')
                                            ->label('Valuación actualizada')
                                            ->numeric()
                                            ->prefix('$'),
                                    ])
                                    ->columns(2)
                                    ->addActionLabel('Agregar bien mueble')
                                    ->columnSpanFull(),
                            ]),
                    ]),

                
                Step::make('Inversiones y Capitales')
                    ->icon('heroicon-o-banknotes')
                    ->schema([
                        Section::make('3. OTROS BIENES INMUEBLES: equipos, instrumental, joyas, objetos de arte, semovientes,etc')
                            ->schema([
                                Repeater::make('otrosBienes')
                                    ->label('')
                                    ->relationship('otrosBienes')
                                    ->schema([
                                        TextInput::make('detalle')
                                            ->label('Detalle')
                                            ->maxLength(255)
                                            ->columnSpan(2),
                                        TextInput::make('valuacion_actualizada')
                                            ->label('Valuación Actualizada')
                                            ->numeric()
                                            ->prefix('$'),
                                    ])
                                    ->columns(3)
                                    ->addActionLabel('Agregar otro bien')
                                    ->columnSpanFull(),
                            ]),

                        Section::make('4. CAPITALES INVERTIDOS EN TÍTULOS, ACCIONES, DEMÁS VALORES COTIZABLES EN BOLSA')
                            ->schema([
                                Repeater::make('capitalesTitulos')
                                    ->label('')
                                    ->relationship('capitalesTitulos')
                                    ->schema([
                                        TextInput::make('tipo')
                                            ->label('Tipo')
                                            ->maxLength(100),
                                        TextInput::make('entidad_emisora')
                                            ->label('Entidad Emisora')
                                            ->maxLength(255),
                                        TextInput::make('cantidad')
                                            ->label('Cantidad')
                                            ->maxLength(50),
                                        TextInput::make('valor_unitario_cotiz')
                                            ->label('Valor unitario de cotiz.')
                                            ->numeric()
                                            ->prefix('$'),
                                        TextInput::make('valor_total')
                                            ->label('Valor Total')
                                            ->numeric()
                                            ->prefix('$'),
                                    ])
                                    ->columns(2)
                                    ->addActionLabel('Agregar título / acción')
                                    ->columnSpanFull(),
                            ]),

                        Section::make('5. CAPITALES INVERTIDOS EN EXPLOTACIONES UNIPERSONALES Y SOCIEDADES QUE NO COTICEN EN BOLSA')
                            ->schema([
                                Repeater::make('capitalesSociedades')
                                    ->label('')
                                    ->relationship('capitalesSociedades')
                                    ->schema([
                                        TextInput::make('denominacion')
                                            ->label('Denominación de la Entidad')
                                            ->maxLength(255),
                                        TextInput::make('ramo_actividad')
                                            ->label('Ramo o Actividad')
                                            ->maxLength(100),
                                        TextInput::make('domicilio')
                                            ->label('Domicilio')
                                            ->maxLength(255),
                                        TextInput::make('porcentaje_capital')
                                            ->label('% sobre cap.')
                                            ->maxLength(10),
                                        TextInput::make('ultima_valuacion')
                                            ->label('Última valuación')
                                            ->numeric()
                                            ->prefix('$'),
                                    ])
                                    ->columns(2)
                                    ->addActionLabel('Agregar sociedad')
                                    ->columnSpanFull(),
                            ]),
                    ]),

                
                Step::make('Disponibilidades')
                    ->icon('heroicon-o-currency-dollar')
                    ->schema([
                        Section::make('6. DEPÓSITOS EN BANCO Y OTRAS ENTIDADES FINANCIERAS')
                            ->schema([
                                Repeater::make('depositos')
                                    ->label('')
                                    ->relationship('depositos')
                                    ->schema([
                                        TextInput::make('tipo')
                                            ->label('Tipo')
                                            ->maxLength(100),
                                        TextInput::make('entidad')
                                            ->label('Entidad')
                                            ->maxLength(255),
                                        TextInput::make('localidad_pais')
                                            ->label('Localidad-País')
                                            ->maxLength(100),
                                        Group::make([
                                            TextInput::make('monto_pesos')
                                                ->label('Monto (Pesos)')
                                                ->numeric()
                                                ->prefix('$'),
                                            TextInput::make('monto_moneda_extranjera')
                                                ->label('Moneda Extranjera')
                                                ->numeric(),
                                        ])->columns(2),
                                    ])
                                    ->columns(2)
                                    ->addActionLabel('Agregar depósito')
                                    ->columnSpanFull(),
                            ]),

                        Section::make('DINERO EN EFECTIVO')
                            ->schema([
                                TextInput::make('dinero_efectivo_pesos')
                                    ->label('Pesos')
                                    ->numeric()
                                    ->prefix('$'),
                                TextInput::make('dinero_efectivo_moneda_extranjera')
                                    ->label('Moneda Extranjera')
                                    ->numeric(),
                            ])
                            ->columns(2),
                    ]),

                
                Step::make('III. CRÉDITOS Y IV. DEUDAS')
                    ->icon('heroicon-o-scale')
                    ->schema([
                        Section::make('7. CRÉDITOS HIPOTECARIOS, PRENDARIOS Y COMUNES')
                            ->schema([
                                Repeater::make('creditos')
                                    ->label('')
                                    ->relationship('creditos')
                                    ->schema([
                                        TextInput::make('apellido_nombre_razon')
                                            ->label('Apellido, Nombre o Razón Social del deudor')
                                            ->maxLength(255),
                                        TextInput::make('identificacion_bien')
                                            ->label('Identificación del bien gravado')
                                            ->maxLength(255),
                                        TextInput::make('nro_inscripcion')
                                            ->label('N° Inscripción de la prenda o hipoteca')
                                            ->maxLength(100),
                                        TextInput::make('monto_credito')
                                            ->label('Monto del crédito a la fecha')
                                            ->numeric()
                                            ->prefix('$'),
                                    ])
                                    ->columns(2)
                                    ->addActionLabel('Agregar crédito')
                                    ->columnSpanFull(),
                            ]),

                        Section::make('8. DETALLE DE DEUDAS HIPOTECARIAS, PRENDARIAS Y COMUNES')
                            ->schema([
                                Repeater::make('deudas')
                                    ->label('')
                                    ->relationship('deudas')
                                    ->schema([
                                        TextInput::make('apellido_nombre_razon')
                                            ->label('Apellido, Nombre o Razón Social del acreedor')
                                            ->maxLength(255),
                                        TextInput::make('identificacion_bien')
                                            ->label('Identificación del bien gravado')
                                            ->maxLength(255),
                                        TextInput::make('nro_inscripcion')
                                            ->label('N° Inscrip. de la prenda o hipoteca')
                                            ->maxLength(100),
                                        TextInput::make('monto_credito')
                                            ->label('Monto adeudado a la fecha')
                                            ->numeric()
                                            ->prefix('$'),
                                    ])
                                    ->columns(2)
                                    ->addActionLabel('Agregar deuda')
                                    ->columnSpanFull(),
                            ]),
                    ]),

                
                Step::make('V. INGRESOS')
                    ->icon('heroicon-o-briefcase')
                    ->schema([
                        Section::make('1. DERIVADOS DEL TRABAJO EN RELACIÓN DE DEPENDENCIA')
                            ->schema([
                                Repeater::make('ingresosDependencia')
                                    ->label('')
                                    ->relationship('ingresosDependencia')
                                    ->schema([
                                        TextInput::make('cargo')
                                            ->label('Cargo')
                                            ->maxLength(150),
                                        TextInput::make('empleador')
                                            ->label('Empleador')
                                            ->maxLength(255),
                                        TextInput::make('monto')
                                            ->label('Monto (Optativo)')
                                            ->numeric()
                                            ->prefix('$'),
                                    ])
                                    ->columns(3)
                                    ->addActionLabel('Agregar cargo')
                                    ->columnSpanFull(),
                            ]),

                        Section::make('2. DERIVADOS DEL EJERCICIO DE ACTIVIDADES INDEPENDIENTES')
                            ->schema([
                                Repeater::make('ingresosIndependiente')
                                    ->label('')
                                    ->relationship('ingresosIndependiente')
                                    ->schema([
                                        TextInput::make('actividad')
                                            ->label('Actividad')
                                            ->maxLength(150),
                                        TextInput::make('empresa_razon_social')
                                            ->label('Empresa o Razón Social')
                                            ->maxLength(255),
                                        TextInput::make('monto')
                                            ->label('Monto (Optativo)')
                                            ->numeric()
                                            ->prefix('$'),
                                    ])
                                    ->columns(3)
                                    ->addActionLabel('Agregar actividad')
                                    ->columnSpanFull(),
                            ]),

                        Section::make('3. DERIVADOS DE LOS SISTEMAS PREVISIONALES (jubilación, retiro, pensión)')
                            ->schema([
                                Repeater::make('ingresosPrevisional')
                                    ->label('')
                                    ->relationship('ingresosPrevisional')
                                    ->schema([
                                        TextInput::make('tipo_beneficio')
                                            ->label('Tipo de beneficio')
                                            ->maxLength(100),
                                        TextInput::make('caja_prevision')
                                            ->label('Caja de Previsión')
                                            ->maxLength(255),
                                        TextInput::make('nro_beneficiario')
                                            ->label('N° de beneficiario')
                                            ->maxLength(50),
                                        TextInput::make('monto')
                                            ->label('Monto (Optativo)')
                                            ->numeric()
                                            ->prefix('$'),
                                    ])
                                    ->columns(2)
                                    ->addActionLabel('Agregar beneficio')
                                    ->columnSpanFull(),
                            ]),
                    ]),

                
                Step::make('Declaración y Cierre')
                    ->icon('heroicon-o-check-circle')
                    ->schema([
                        Section::make('Finalización')
                            ->description('Declaración de veracidad de los datos suministrados.')
                            ->schema([
                                TextInput::make('lugar_fecha')
                                    ->label('Lugar y Fecha')
                                    ->maxLength(255)
                                    ->default('Río Cuarto, ' . now()->format('d/m/Y')),

                                DatePicker::make('fecha_declaracion')
                                    ->label('Fecha efectiva para el sistema')
                                    ->native(false)
                                    ->default(now()),

                                \Filament\Forms\Components\Placeholder::make('footer')
                                    ->label('')
                                    ->content('Al hacer clic en "Guardar", usted confirma que los datos expresados en este formulario son veraces y tienen carácter de Declaración Jurada conforme a la Ordenanza 747/98.')
                                    ->columnSpanFull(),
                            ])
                            ->columns(2),
                    ]),
            ])
                ->columnSpanFull()
                ->skippable(),
        ]);
    }
}
