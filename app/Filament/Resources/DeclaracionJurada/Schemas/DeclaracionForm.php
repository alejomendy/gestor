<?php

namespace App\Filament\Resources\DeclaracionJurada\Schemas;

use App\Models\Worker;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Schema;

class DeclaracionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Wizard::make([

                // ─── PASO 1: Datos del Declarante ───────────────────────────
                Step::make('Datos del Declarante')
                    ->icon('heroicon-o-user')
                    ->schema([
                        Select::make('worker_id')
                            ->label('Empleado')
                            ->options(
                                Worker::query()
                                    ->orderBy('last_name')
                                    ->get()
                                    ->mapWithKeys(fn($w) => [$w->id => $w->last_name . ', ' . $w->name])
                            )
                            ->searchable()
                            ->required()
                            ->default(request()->query('worker_id'))
                            ->columnSpanFull(),

                        TextInput::make('legajo')
                            ->label('N° de Legajo')
                            ->maxLength(50),

                        Select::make('estado_civil')
                            ->label('Estado Civil')
                            ->options([
                                'soltero' => 'Soltero/a',
                                'casado' => 'Casado/a',
                                'divorciado' => 'Divorciado/a',
                                'viudo' => 'Viudo/a',
                                'union' => 'Unión convivencial',
                            ]),

                        TextInput::make('ci_numero')
                            ->label('C.I. N°')
                            ->maxLength(20),

                        TextInput::make('ci_expedida_por')
                            ->label('Expedida por')
                            ->maxLength(100),

                        TextInput::make('profesion')
                            ->label('Profesión')
                            ->maxLength(100),

                        TextInput::make('domicilio')
                            ->label('Domicilio')
                            ->maxLength(255)
                            ->columnSpanFull(),

                        DatePicker::make('fecha_declaracion')
                            ->label('Fecha de declaración')
                            ->native(false),

                        TextInput::make('lugar_fecha')
                            ->label('Lugar y Fecha (texto libre)')
                            ->maxLength(255),
                    ])
                    ->columns(2),

                // ─── PASO 2: Datos del Cónyuge e Hijos Menores ────────────
                Step::make('Datos Familiares')
                    ->icon('heroicon-o-users')
                    ->schema([
                        Repeater::make('familiares')
                            ->label('Cónyuge e Hijos Menores')
                            ->relationship('familiares')
                            ->schema([
                                TextInput::make('apellido_nombres')
                                    ->label('Apellido y Nombres')
                                    ->maxLength(255)
                                    ->columnSpan(3),
                                TextInput::make('parentesco')
                                    ->label('Parentesco')
                                    ->maxLength(50),
                                Select::make('doc_tipo')
                                    ->label('Tipo Documento')
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
                            ->columns(6)
                            ->addActionLabel('Agregar familiar')
                            ->columnSpanFull(),
                    ]),

                // ─── PASO 3: Bienes Inmuebles ────────────────────────────
                Step::make('Bienes Inmuebles')
                    ->icon('heroicon-o-home')
                    ->schema([
                        Repeater::make('bienesInmuebles')
                            ->label('Bienes Inmuebles')
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
                                TextInput::make('valuacion_fiscal_importe')
                                    ->label('Última Val. Fiscal — Importe')
                                    ->numeric()
                                    ->prefix('$'),
                                TextInput::make('valuacion_fiscal_anio')
                                    ->label('Año')
                                    ->numeric()
                                    ->minValue(1900)
                                    ->maxValue(2100),
                            ])
                            ->columns(2)
                            ->addActionLabel('Agregar inmueble')
                            ->columnSpanFull(),
                    ]),

                // ─── PASO 4: Bienes Muebles Registrables ─────────────────
                Step::make('Bienes Muebles')
                    ->icon('heroicon-o-truck')
                    ->schema([
                        Repeater::make('bienesMuebles')
                            ->label('Bienes Muebles Registrables (automotores, naves, aeronaves, yates, motocicletas)')
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

                // ─── PASO 5: Otros Bienes / Capitales / Depósitos ─────────
                Step::make('Otros Bienes y Capitales')
                    ->icon('heroicon-o-banknotes')
                    ->schema([
                        Repeater::make('otrosBienes')
                            ->label('3. Otros Bienes (equipos, joyas, obras de arte, semovientes, etc.)')
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

                        Repeater::make('capitalesTitulos')
                            ->label('4. Capitales en Títulos, Acciones y valores cotizables')
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
                                    ->label('Valor unitario cotiz.')
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

                        Repeater::make('capitalesSociedades')
                            ->label('5. Capitales en explotaciones unipersonales y sociedades que no coticen en bolsa')
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

                        Repeater::make('depositos')
                            ->label('6. Depósitos en Banco y otras entidades financieras')
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
                                TextInput::make('monto_pesos')
                                    ->label('Monto (Pesos)')
                                    ->numeric()
                                    ->prefix('$'),
                                TextInput::make('monto_moneda_extranjera')
                                    ->label('Moneda Extranjera')
                                    ->numeric()
                                    ->prefix('U$D'),
                            ])
                            ->columns(2)
                            ->addActionLabel('Agregar depósito')
                            ->columnSpanFull(),
                    ]),

                // ─── PASO 6: Créditos y Deudas ───────────────────────────
                Step::make('Créditos y Deudas')
                    ->icon('heroicon-o-scale')
                    ->schema([
                        Repeater::make('creditos')
                            ->label('7. Créditos Hipotecarios, Prendarios y Comunes')
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

                        Repeater::make('deudas')
                            ->label('8. Detalle de Deudas Hipotecarias, Prendarias y Comunes')
                            ->relationship('deudas')
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
                            ->addActionLabel('Agregar deuda')
                            ->columnSpanFull(),
                    ]),

                // ─── PASO 7: Ingresos / Labores ─────────────────────────
                Step::make('Ingresos y Labores')
                    ->icon('heroicon-o-briefcase')
                    ->schema([
                        Repeater::make('ingresosDependencia')
                            ->label('1. Derivados del Trabajo en Relación de Dependencia')
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

                        Repeater::make('ingresosIndependiente')
                            ->label('2. Derivados del ejercicio de actividades independientes')
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

                        Repeater::make('ingresosPrevisional')
                            ->label('3. Derivados de los Sistemas Previsionales (jubilación, retiro, pensión)')
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

            ])
                ->columnSpanFull()
                ->skippable(),
        ]);
    }
}
