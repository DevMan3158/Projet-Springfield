@echo off

if exist %~dp0\.env (
    rem file exist
) else (
    if exist %~dp0\.env.example (
        copy %~dp0\.env.example %~dp0\.env
    ) else (
        rem file doesn't exist
    )
)

docker compose up -d
