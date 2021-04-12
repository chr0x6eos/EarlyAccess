#!/bin/bash

# Install script by Chr0x6eOs
VERBOSE=0
SEED=0
steps=4 # Installation steps
c=1 # Counter

function usage { # Print usage
  echo -e "
Usage: $0 [arguments]
-h  ... Help:       Print this help message
-v  ... Verbose:    Print detailed status messages
-s  ... Seed:       Seed database
"
}

function log { # Log messages
    # Success and Errors will always be logged
    if [[ "$2" -eq -1 ]] # Error: Red color
     then
        echo -e "\e[5m----------------------------------------------------\e[0m"
        echo -e "\e[91m[-]\e[0m $1"
        exit -1
    elif [[ "$2" -eq 1 ]] # Success: Green color
     then
        #echo "----------------------------------------------------"
        echo -e "\e[92m[+]\e[0m $1"
    fi

    if [[ "$2" -eq 0 ]] # Ok: Blue color
     then
        echo -e "\e[5m----------------------------------------------------\e[0m"
        echo -e "\e[34m[*]\e[0m $1"
    elif [[ "$2" -eq 2 ]] # Info: Yellow color
     then
        echo -e "\e[5m----------------------------------------------------\e[0m"
        echo -e "\e[93m[~]\e[0m $1"
    fi
}

function log_if_error { # Logs an error if last execution failed
  if [[ "$?" -ne 0 ]]
   then
     if [[ -z "$1" ]]
      then
        log "Error occurred! Exiting..." -1
      else
        log "$1" -1 # Log with message
     fi
     exit -1 # Exit with errors
  fi
}


function info {
echo ''
echo -e '\e[93m  _____                 _             _   _                         _           _   \e[0m'
echo -e '\e[93m |_   _|               | |           | | | |                       (_)         | |  \e[0m'
echo -e '\e[93m   | |    _ __    ___  | |_    __ _  | | | |    ___    ___   _ __   _   _ __   | |_ \e[0m'
echo -e '\e[93m   | |   |  _ \  / __| | __|  / _` | | | | |   / __|  / __| |  __| | | |  _ \  | __|\e[0m'
echo -e '\e[93m  _| |_  | | | | \__ \ | |_  | (_| | | | | |   \__ \ | (__  | |    | | | |_) | | |_ \e[0m'
echo -e '\e[93m |_____| |_| |_| |___/  \__|  \__,_| |_| |_|   |___/  \___| |_|    |_| | .__/   \__|\e[0m'
echo -e '\e[93m                                                                       | |          \e[0m'
echo -e '\e[93m                                                                       |_|          \e[0m'
echo -e 'By \e[92mChr0x6eOs\e[0m [ https://github.com/chr0x6eos ]'
echo ''
echo 'Use -h to print help'
echo ''
}

####################
#     MAIN-CODE    #
####################
info # Print info

for (( i=0; i<="$#"; i++))
 do
    if [[ "${!i}" == "-h" ]] # Print help
     then
       usage
       exit 0
    elif [[ "${!i}" == "-v" ]] # Set verbosity
     then
        VERBOSE=1
        log "Verbosity set!" 0
    elif [[ "${!i}" == "-s" ]] # Set seed
     then
        SEED=1
        ((steps=steps+1))
        log "Seeders will be run!" 0
    fi
done

log "Setting up dev environment..." 2

#Installing vendor dir
log "[$c/$steps] Installing vendor dir..." 0
if [ $VERBOSE -gt 0 ]
 then
    composer install
else
    composer install 2>&1 1>/dev/null
fi
log_if_error "Could not install vendor dir!"
log "Successfully installed vendor dir!" 1

((c=c+1))

#Generating key
log "[$c/$steps] Creating php artisan key..." 0
if [ $VERBOSE -gt 0 ]
 then
     php artisan key:generate
else
     php artisan key:generate 2>&1 1>/dev/null
fi
log_if_error "Could not generate php artisan key!"
log "Successfully generated php artisan key!"

((c=c+1))

#Migrate db
log  "[$c/$steps] Migrating database..." 0
if [ $VERBOSE -gt 0 ]
 then
     php artisan migrate
else
     php artisan migrate 2>&1 1>/dev/null
fi
log_if_error "Could not migrate database!"
log "Successfully migrated database!" 1

((c=c+1))

#Seed DB (Optional)
log "[Additional] Seeding database..."
if [ $VERBOSE -gt 0 ]
 then
     php artisan db:seed
else
     php artisan db:seed 2>&1 1>/dev/null
fi
log_if_error "Could not seed database!"
log "Successfully seeded database!" 1

#NPM install
log "[$c/$steps] Running NPM install and NPM run dev..." 0
if [ $VERBOSE -gt 0 ]
 then
     npm install
     npm run dev
else
    ( npm install &&  npm run dev) 2>&1 1>/dev/null
fi
log_if_error "Errors occurred while running NPM install!"
log "Successfully ran NPM install!" 1

((c=c+1))

log "Successfully setup dev-environment! Exiting..." 1
exit 0