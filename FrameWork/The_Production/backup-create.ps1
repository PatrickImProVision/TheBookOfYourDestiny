# Backup script for CodeIgniter project
# Creates a zip named "FrameWork Fundamental v1.0.0.zip" in the Backup folder

$projectRoot = $PSScriptRoot
$backupDir = Join-Path $projectRoot "Backup"
$zipName = "CodeIgniter_FrameWork_v4.6.4.zip"
$zipPath = Join-Path $backupDir $zipName

# Ensure backup directory exists
if (-not (Test-Path -Path $backupDir)) {
    New-Item -ItemType Directory -Path $backupDir -Force | Out-Null
}

# Remove existing zip if present
if (Test-Path -Path $zipPath) {
    Remove-Item -Path $zipPath -Force
}

# Get all items in project root, excluding the Backup folder, .vscode, and the zip itself
$items = Get-ChildItem -Path $projectRoot -Force | Where-Object { $_.Name -ne 'Backup' -and $_.Name -ne '.vscode' -and $_.FullName -ne $zipPath } | Select-Object -ExpandProperty FullName

# Compress to zip
Compress-Archive -LiteralPath $items -DestinationPath $zipPath -Force

Write-Host "Backup created:" $zipPath
