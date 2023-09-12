$destDir = "$env:USERPROFILE\Desktop\ficheros_organizados_por_fecha"

# Crea la carpeta principal si no existe
if (-not (Test-Path $destDir)) {
    New-Item -ItemType Directory -Path $destDir
}

# Itera sobre todos los archivos en el directorio actual
Get-ChildItem -File | ForEach-Object {
    # Obtener fecha de creación en formato YYYY-MM-DD
    $folderName = $_.CreationTime.ToString('yyyy-MM-dd')
    $subDir = Join-Path $destDir $folderName

    # Crea el directorio con la fecha si no existe
    if (-not (Test-Path $subDir)) {
        New-Item -ItemType Directory -Path $subDir
    }

    # Copia el archivo al directorio correspondiente
    Copy-Item $_.FullName -Destination $subDir
}

Write-Output "¡Archivos copiados y organizados por fecha de creación en el escritorio!"