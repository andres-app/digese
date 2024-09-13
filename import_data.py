import pandas as pd
from sqlalchemy import create_engine, text  # Importar 'text' para ejecutar comandos SQL

# Configura la conexión a la base de datos MySQL
db_user = 'root'
db_password = ''
db_host = 'localhost'  # Cambia esto si tu base de datos está en otro servidor
db_name = 'digese'

# Crear la conexión usando SQLAlchemy
engine = create_engine(f'mysql+pymysql://{db_user}:{db_password}@{db_host}/{db_name}')

# Cargar los datos del archivo Excel
file_path = './data/Seguimiento_digese.xlsx'
sheet_name = 'Sin desagregar los items'
data = pd.read_excel(file_path, sheet_name=sheet_name)

# Mostrar los nombres de las columnas del DataFrame
print("Columnas en el DataFrame cargado:")
print(data.columns)

# Ajusta los nombres de las columnas según la salida de print(data.columns)
procesos_cols = ['N°', 'DIREC', 'GRUPO', 'OBTENCIÓN', 'NOMBRE', 'CANT. ITEMS',
                 'CANT. UNIDADES', 'SINAD', 'PRESUPUESTO - MONTO PREVISTO EN RM Nro 335',
                 'PRESUPUESTO - VALOR ESTIMADO', 'FECHA DE REQUERIMIENTO', 
                 'Especialista UARE a cargo', 'ACOTACIONES ADICIONALES']

# Verificar columnas existentes en el DataFrame antes de seleccionar
missing_cols = [col for col in procesos_cols if col not in data.columns]
if missing_cols:
    print(f"Las siguientes columnas no se encuentran en el DataFrame: {missing_cols}")

# Seleccionar las columnas correspondientes del DataFrame si existen
procesos_data = data[procesos_cols].copy()  # Asegúrate de que todos los nombres de columna coincidan
procesos_data.columns = ['numero_proceso', 'direc', 'grupo', 'obtencion', 'nombre', 'cant_items', 
                         'cant_unidades', 'sinad', 'presupuesto_monto_previsto', 'presupuesto_valor_estimado', 
                         'fecha_inicio', 'especialista_uare', 'acotaciones_adicionales']  # Renombrar columnas
procesos_data.to_sql('procesos', con=engine, if_exists='append', index=False)

# Definir los tipos de eventos y las columnas correspondientes en el Excel
event_types = {
    'FECHA DE REQUERIMIENTO': 'Fecha de Requerimiento',
    'INDAGACION MERCADO - FECHA DE CULMINACION': 'Indagación Mercado',
    'FECHA DE CONVOCATORIA': 'Fecha de Convocatoria',
    'FIRMA ESTIMADA DE CONTRATO': 'Firma Estimada de Contrato',
    'EJECUCIÓN - INGRESO ESTIMADO ALMACÉN': 'Ingreso Estimado Almacén',
    'EJECUCIÓN - FECHA ESTIMADA DE CONFORMIDAD': 'Fecha Estimada de Conformidad',
    'EJECUCIÓN - CON CONFORMIDAD': 'Conformidad'
}

# Crear una lista para almacenar los eventos
eventos_list = []

# Transformar los datos
for index, row in data.iterrows():
    proceso_id = row['N°']
    
    # Eliminar registros existentes para este proceso_id antes de agregar nuevos
    with engine.connect() as connection:
        # Usar text() para ejecutar la consulta SQL
        connection.execute(text(f"DELETE FROM eventos WHERE proceso_id = {proceso_id}"))
    
    for event_col, event_name in event_types.items():
        if event_col in data.columns and pd.notna(row[event_col]):  # Verificar que la columna existe y no sea NaN
            eventos_list.append({
                'proceso_id': proceso_id,
                'descripcion_evento': event_name,
                'fecha_evento': row[event_col],
                'tipo_evento': event_name
            })

# Convertir la lista de eventos en un DataFrame
eventos_data = pd.DataFrame(eventos_list)

# Convertir la columna de fecha a un formato de fecha válido
eventos_data['fecha_evento'] = pd.to_datetime(eventos_data['fecha_evento'], errors='coerce')

# Filtrar las filas donde la fecha no es válida
eventos_data = eventos_data.dropna(subset=['fecha_evento'])

# Importar datos a la tabla `eventos`
eventos_data.to_sql('eventos', con=engine, if_exists='append', index=False)

print("Datos importados exitosamente.")
