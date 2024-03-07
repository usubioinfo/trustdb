# Start from Ubuntu 22.04 base image
FROM ubuntu:22.04

# Avoid prompts from apt during build
ENV DEBIAN_FRONTEND=noninteractive

# Update and install Apache, PHP, MySQL, and dependencies for R installation
RUN apt-get update && apt-get install -y \
    apache2 \
    php \
    php-mysql \
    mysql-server \
    libapache2-mod-php \
    php-curl \
    git \
    curl \
    software-properties-common \
    libcurl4-openssl-dev \
    libmariadb-dev \
    dirmngr \
    gnupg \
    apt-transport-https \
    ca-certificates \
    lsb-release \
    --no-install-recommends \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Add the R signing key directly from the Ubuntu keyserver and add the R repository
RUN curl -sS https://cloud.r-project.org/bin/linux/ubuntu/marutter_pubkey.asc | gpg --dearmor > /usr/share/keyrings/cran-archive-keyring.gpg \
    && echo "deb [signed-by=/usr/share/keyrings/cran-archive-keyring.gpg] https://cloud.r-project.org/bin/linux/ubuntu $(lsb_release -cs)-cran40/" > /etc/apt/sources.list.d/cran.list

# Install R
RUN apt-get update && apt-get install -y r-base

# Install R packages
RUN R -e "install.packages('data.table', repos='http://cran.rstudio.com/')"
RUN R -e "install.packages('RMySQL', repos='http://cran.rstudio.com/')"
# Enable headers module
RUN a2enmod headers

# Enable rewrite module
RUN a2enmod rewrite

# Clone your application from a Git repository
# Replace <your-git-repo-url> with the actual URL of your repository
# RUN git clone https://github.com/usubioinfo/trustdb.git /var/www/html/trustdb
COPY . /var/www/html/trustdb

# Copy directories
# COPY BlastDB /var/www/html/trustdb/BlastDB
# COPY Interolog /var/www/html/trustdb/Interolog
# COPY ProteomesFASTA /var/www/html/trustdb/ProteomesFASTA
# COPY R_Access /var/www/html/trustdb/R_Access
# COPY tmp /var/www/html/trustdb/tmp
# COPY orthologs /var/www/html/trustdb/orthologs
# COPY weconet_try /var/www/html/trustdb/weconet_try
# COPY assets /var/www/html/trustdb/assets

# Copy individual files
# COPY *.fasta /var/www/html/trustdb/
# COPY config.php /var/www/html/trustdb/
# COPY config1.php /var/www/html/trustdb/
# COPY faSomeRecords /var/www/html/trustdb/

# Copy your specific database dump into the container
COPY trustdb_dump.sql /docker-entrypoint-initdb.d/trustdb_dump.sql

# Copy the custom start script to the container
COPY start.sh /usr/local/bin/start.sh
RUN chmod +x /usr/local/bin/start.sh

# Expose port 80 for Apache
EXPOSE 80

# Expose MySQL port
# EXPOSE 3306

# Start Apache, MySQL, and import databases
CMD ["/usr/local/bin/start.sh"]
